<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use GuzzleHttp\Client;

class DonationController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Donate', [
            'publicKey' => config('services.stripe.key'),
        ]);
    }

    public function success(): Response
    {
        return Inertia::render('Donate', ['status' => 'success']);
    }

    public function failure(): Response
    {
        return Inertia::render('Donate', ['status' => 'failure']);
    }

    /**
     * @throws ApiErrorException
     */
    public function paymentIntent(Request $request): JsonResponse
    {
        $data = $request->validate([
            'amount' => ['required', 'integer', 'min:100'],
            'currency' => ['nullable', 'string', 'size:3'],
        ]);

        $secret = config('services.stripe.secret');
        if (! $secret) {
            return response()->json([
                'client_secret' => 'demo_mode',
            ]);
        }

        Stripe::setApiKey($secret);

        $intent = PaymentIntent::create([
            'amount' => $data['amount'],
            'currency' => strtolower($data['currency'] ?? 'usd'),
            'automatic_payment_methods' => ['enabled' => true],
        ]);

        return response()->json([
            'client_secret' => $intent->client_secret,
        ]);
    }

    public function store(): RedirectResponse
    {
        return to_route('donate.success');
    }


    public function createPayment(Request $request){
        $client = new Client();

        // $amount = $request->input("amount");
        // $description = $request->input("description");
        // $email = $request->input("email");
        // $callbackUrl = $request->input('callback_url');
        $consumerKey = env('CONSUMER_KEY');
        $consumerSecret = env('CONSUMER_SECRET');

        // processing requests
        $requiredKeys = ['amount', 'description', 'email']; 

        foreach ($requiredKeys as $key) {
          if (!$request->has($key)) {
              return response()->json(['error' => 'Missing required key: ' . $key], 400);
          }
        }

      
        
      // Define subscription details
      $amount = "500"; // Subscription amount
      $description = "Monthly Subscription"; // Payment description
      $type = "MERCHANT"; // Payment type
      $reference = uniqid(); // Unique payment reference
      // $email = "jj@example.com"; // Customer's email
      
      // Initialize PesaPal consumer
      $consumer = new OAuthConsumer($consumerKey, $consumerSecret);
        
        // PesaPal URL endpoints
        // $callbackUrl = "https://localhost/nenapay/callback.php"; // Replace with your callback URL
        $pesaPalPostUrl = "https://www.pesapal.com/API/PostPesapalDirectOrderV4"; // API endpoint
        
        // Prepare the request
        $postXml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
        <PesapalDirectOrderInfo
          xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
          xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"
          Amount=\"$amount\"
          Description=\"$description\"
          Type=\"$type\"
          Reference=\"$reference\"
          Email=\"$email\"
          xmlns=\"http://www.pesapal.com\" />";
        
        $postXml = htmlentities($postXml);
        
        // Generate OAuth signature
        $signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();
        $request = OAuthRequest::from_consumer_and_token($consumer, NULL, "POST", $pesaPalPostUrl, NULL);
        $request->set_parameter("oauth_callback", $callbackUrl);
        $request->set_parameter("pesapal_request_data", $postXml);
        $request->sign_request($signatureMethod, $consumer, NULL);
        
        // Get the signed URL
        $signedUrl = $request->to_url();

        return view('welcome',["url"=>$signedUrl]);
    }
}
class OAuthConsumer {
    public $key;
    public $secret;
  
    function __construct($key, $secret, $callback_url=NULL) {
      $this->key = $key;
      $this->secret = $secret;
      $this->callback_url = $callback_url;
    }
  
    function __toString() {
      return "OAuthConsumer[key=$this->key,secret=$this->secret]";
    }
}

class OAuthToken {
    // access tokens and request tokens
    public $key;
    public $secret;

    /**
    * key = the token
    * secret = the token secret
    */
    function __construct($key, $secret) {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
    * generates the basic string serialization of a token that a server
    * would respond to request_token and access_token calls with
    */
    function to_string() {
        return "oauth_token=" .
        OAuthUtil::urlencode_rfc3986($this->key) .
        "&oauth_token_secret=" .
        OAuthUtil::urlencode_rfc3986($this->secret);
    }

    function __toString() {
        return $this->to_string();
    }
}

class OAuthSignatureMethod {
    public function check_signature(&$request, $consumer, $token, $signature) {
      $built = $this->build_signature($request, $consumer, $token);
      return $built == $signature;
    }
}

class OAuthSignatureMethod_HMAC_SHA1 extends OAuthSignatureMethod {
    function get_name() {
      return "HMAC-SHA1";
    }
  
    public function build_signature($request, $consumer, $token) {
      $base_string = $request->get_signature_base_string();
      $request->base_string = $base_string;
  
      $key_parts = array(
        $consumer->secret,
        ($token) ? $token->secret : ""
      );
  
      $key_parts = OAuthUtil::urlencode_rfc3986($key_parts);
      $key = implode('&', $key_parts);
  
      return base64_encode(hash_hmac('sha1', $base_string, $key, true));
    }
}

class OAuthSignatureMethod_PLAINTEXT extends OAuthSignatureMethod {
    public function get_name() {
      return "PLAINTEXT";
    }
  
    public function build_signature($request, $consumer, $token) {
      $sig = array(
        OAuthUtil::urlencode_rfc3986($consumer->secret)
      );
  
      if ($token) {
        array_push($sig, OAuthUtil::urlencode_rfc3986($token->secret));
      } else {
        array_push($sig, '');
      }
  
      $raw = implode("&", $sig);
      // for debug purposes
      $request->base_string = $raw;
  
      return OAuthUtil::urlencode_rfc3986($raw);
    }
  }

  class OAuthSignatureMethod_RSA_SHA1 extends OAuthSignatureMethod {
    public function get_name() {
      return "RSA-SHA1";
    }
  
    protected function fetch_public_cert(&$request) {
      // not implemented yet, ideas are:
      // (1) do a lookup in a table of trusted certs keyed off of consumer
      // (2) fetch via http using a url provided by the requester
      // (3) some sort of specific discovery code based on request
      //
      // either way should return a string representation of the certificate
      throw Exception("fetch_public_cert not implemented");
    }
  
    protected function fetch_private_cert(&$request) {
      // not implemented yet, ideas are:
      // (1) do a lookup in a table of trusted certs keyed off of consumer
      //
      // either way should return a string representation of the certificate
      throw Exception("fetch_private_cert not implemented");
    }
  
    public function build_signature(&$request, $consumer, $token) {
      $base_string = $request->get_signature_base_string();
      $request->base_string = $base_string;
  
      // Fetch the private key cert based on the request
      $cert = $this->fetch_private_cert($request);
  
      // Pull the private key ID from the certificate
      $privatekeyid = openssl_get_privatekey($cert);
  
      // Sign using the key
      $ok = openssl_sign($base_string, $signature, $privatekeyid);
  
      // Release the key resource
      openssl_free_key($privatekeyid);
  
      return base64_encode($signature);
    }
  
    public function check_signature(&$request, $consumer, $token, $signature) {
      $decoded_sig = base64_decode($signature);
  
      $base_string = $request->get_signature_base_string();
  
      // Fetch the public key cert based on the request
      $cert = $this->fetch_public_cert($request);
  
      // Pull the public key ID from the certificate
      $publickeyid = openssl_get_publickey($cert);
  
      // Check the computed signature against the one passed in the query
      $ok = openssl_verify($base_string, $decoded_sig, $publickeyid);
  
      // Release the key resource
      openssl_free_key($publickeyid);
  
      return $ok == 1;
    }
  }

  class OAuthRequest {
    private $parameters;
    private $http_method;
    private $http_url;
    // for debug purposes
    public $base_string;
    public static $version = '1.0';
    public static $POST_INPUT = 'php://input';
  
    function __construct($http_method, $http_url, $parameters=NULL) {
      @$parameters or $parameters = array();
      $this->parameters = $parameters;
      $this->http_method = $http_method;
      $this->http_url = $http_url;
    }
  
  
    /**
     * attempt to build up a request from what was passed to the server
     */
    public static function from_request($http_method=NULL, $http_url=NULL, $parameters=NULL) {
      $scheme = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on")
                ? 'http'
                : 'https';
      @$http_url or $http_url = $scheme .
                                '://' . $_SERVER['HTTP_HOST'] .
                                ':' .
                                $_SERVER['SERVER_PORT'] .
                                $_SERVER['REQUEST_URI'];
      @$http_method or $http_method = $_SERVER['REQUEST_METHOD'];
  
      // We weren't handed any parameters, so let's find the ones relevant to
      // this request.
      // If you run XML-RPC or similar you should use this to provide your own
      // parsed parameter-list
      if (!$parameters) {
        // Find request headers
        $request_headers = OAuthUtil::get_headers();
  
        // Parse the query-string to find GET parameters
        $parameters = OAuthUtil::parse_parameters($_SERVER['QUERY_STRING']);
  
        // It's a POST request of the proper content-type, so parse POST
        // parameters and add those overriding any duplicates from GET
        if ($http_method == "POST"
            && @strstr($request_headers["Content-Type"],
                       "application/x-www-form-urlencoded")
            ) {
          $post_data = OAuthUtil::parse_parameters(
            file_get_contents(self::$POST_INPUT)
          );
          $parameters = array_merge($parameters, $post_data);
        }
  
        // We have a Authorization-header with OAuth data. Parse the header
        // and add those overriding any duplicates from GET or POST
        if (@substr($request_headers['Authorization'], 0, 6) == "OAuth ") {
          $header_parameters = OAuthUtil::split_header(
            $request_headers['Authorization']
          );
          $parameters = array_merge($parameters, $header_parameters);
        }
  
      }
  
      return new OAuthRequest($http_method, $http_url, $parameters);
    }
  
    /**
     * pretty much a helper function to set up the request
     */
    public static function from_consumer_and_token($consumer, $token, $http_method, $http_url, $parameters=NULL) {
      @$parameters or $parameters = array();
      $defaults = array("oauth_version" => OAuthRequest::$version,
                        "oauth_nonce" => OAuthRequest::generate_nonce(),
                        "oauth_timestamp" => OAuthRequest::generate_timestamp(),
                        "oauth_consumer_key" => $consumer->key);
      if ($token)
        $defaults['oauth_token'] = $token->key;
  
      $parameters = array_merge($defaults, $parameters);
  
      return new OAuthRequest($http_method, $http_url, $parameters);
    }
  
    public function set_parameter($name, $value, $allow_duplicates = true) {
      if ($allow_duplicates && isset($this->parameters[$name])) {
        // We have already added parameter(s) with this name, so add to the list
        if (is_scalar($this->parameters[$name])) {
          // This is the first duplicate, so transform scalar (string)
          // into an array so we can add the duplicates
          $this->parameters[$name] = array($this->parameters[$name]);
        }
  
        $this->parameters[$name][] = $value;
      } else {
        $this->parameters[$name] = $value;
      }
    }
  
    public function get_parameter($name) {
      return isset($this->parameters[$name]) ? $this->parameters[$name] : null;
    }
  
    public function get_parameters() {
      return $this->parameters;
    }
  
    public function unset_parameter($name) {
      unset($this->parameters[$name]);
    }
  
    /**
     * The request parameters, sorted and concatenated into a normalized string.
     * @return string
     */
    public function get_signable_parameters() {
      // Grab all parameters
      $params = $this->parameters;
  
      // Remove oauth_signature if present
      // Ref: Spec: 9.1.1 ("The oauth_signature parameter MUST be excluded.")
      if (isset($params['oauth_signature'])) {
        unset($params['oauth_signature']);
      }
  
      return OAuthUtil::build_http_query($params);
    }
  
    /**
     * Returns the base string of this request
     *
     * The base string defined as the method, the url
     * and the parameters (normalized), each urlencoded
     * and the concated with &.
     */
    public function get_signature_base_string() {
      $parts = array(
        $this->get_normalized_http_method(),
        $this->get_normalized_http_url(),
        $this->get_signable_parameters()
      );
  
      $parts = OAuthUtil::urlencode_rfc3986($parts);
  
      return implode('&', $parts);
    }
  
    /**
     * just uppercases the http method
     */
    public function get_normalized_http_method() {
      return strtoupper($this->http_method);
    }
  
    /**
     * parses the url and rebuilds it to be
     * scheme://host/path
     */
    public function get_normalized_http_url() {
      $parts = parse_url($this->http_url);
  
      $port = @$parts['port'];
      $scheme = $parts['scheme'];
      $host = $parts['host'];
      $path = @$parts['path'];
  
      $port or $port = ($scheme == 'https') ? '443' : '80';
  
      if (($scheme == 'https' && $port != '443')
          || ($scheme == 'http' && $port != '80')) {
        $host = "$host:$port";
      }
      return "$scheme://$host$path";
    }
  
    /**
     * builds a url usable for a GET request
     */
    public function to_url() {
      $post_data = $this->to_postdata();
      $out = $this->get_normalized_http_url();
      if ($post_data) {
        $out .= '?'.$post_data;
      }
      return $out;
    }
  
    /**
     * builds the data one would send in a POST request
     */
    public function to_postdata() {
      return OAuthUtil::build_http_query($this->parameters);
    }
  
    /**
     * builds the Authorization: header
     */
    public function to_header() {
      $out ='Authorization: OAuth realm=""';
      $total = array();
      foreach ($this->parameters as $k => $v) {
        if (substr($k, 0, 5) != "oauth") continue;
        if (is_array($v)) {
          throw new OAuthException('Arrays not supported in headers');
        }
        $out .= ',' .
                OAuthUtil::urlencode_rfc3986($k) .
                '="' .
                OAuthUtil::urlencode_rfc3986($v) .
                '"';
      }
      return $out;
    }
  
    public function __toString() {
      return $this->to_url();
    }
  
  
    public function sign_request($signature_method, $consumer, $token) {
      $this->set_parameter(
        "oauth_signature_method",
        $signature_method->get_name(),
        false
      );
      $signature = $this->build_signature($signature_method, $consumer, $token);
      $this->set_parameter("oauth_signature", $signature, false);
    }
  
    public function build_signature($signature_method, $consumer, $token) {
      $signature = $signature_method->build_signature($this, $consumer, $token);
      return $signature;
    }
  
    /**
     * util function: current timestamp
     */
    private static function generate_timestamp() {
      return time();
    }
  
    /**
     * util function: current nonce
     */
    private static function generate_nonce() {
      mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
      $charid = strtoupper(md5(uniqid(rand(), true)));
      $hyphen = chr(45);// "-"
      $uuid = chr(123)// "{"
              .substr($charid, 0, 8).$hyphen
              .substr($charid, 8, 4).$hyphen
              .substr($charid,12, 4).$hyphen
              .substr($charid,16, 4).$hyphen
              .substr($charid,20,12)
              .chr(125);// "}"
      return $uuid;
    }
  }

  class OAuthUtil {
    public static function urlencode_rfc3986($input) {
    if (is_array($input)) {
      return array_map(array('OAuthUtil', 'urlencode_rfc3986'), $input);
    } else if (is_scalar($input)) {
      return str_replace(
        '+',
        ' ',
        str_replace('%7E', '~', rawurlencode($input))
      );
    } else {
      return '';
    }
  }
  
  
    // This decode function isn't taking into consideration the above
    // modifications to the encoding process. However, this method doesn't
    // seem to be used anywhere so leaving it as is.
    public static function urldecode_rfc3986($string) {
      return urldecode($string);
    }
  
    // Utility function for turning the Authorization: header into
    // parameters, has to do some unescaping
    // Can filter out any non-oauth parameters if needed (default behaviour)
    public static function split_header($header, $only_allow_oauth_parameters = true) {
      $pattern = '/(([-_a-z]*)=("([^"]*)"|([^,]*)),?)/';
      $offset = 0;
      $params = array();
      while (preg_match($pattern, $header, $matches, PREG_OFFSET_CAPTURE, $offset) > 0) {
        $match = $matches[0];
        $header_name = $matches[2][0];
        $header_content = (isset($matches[5])) ? $matches[5][0] : $matches[4][0];
        if (preg_match('/^oauth_/', $header_name) || !$only_allow_oauth_parameters) {
          $params[$header_name] = OAuthUtil::urldecode_rfc3986($header_content);
        }
        $offset = $match[1] + strlen($match[0]);
      }
  
      if (isset($params['realm'])) {
        unset($params['realm']);
      }
  
      return $params;
    }
  
    // helper to try to sort out headers for people who aren't running apache
    public static function get_headers() {
      if (function_exists('apache_request_headers')) {
        // we need this to get the actual Authorization: header
        // because apache tends to tell us it doesn't exist
        return apache_request_headers();
      }
      // otherwise we don't have apache and are just going to have to hope
      // that $_SERVER actually contains what we need
      $out = array();
      foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) == "HTTP_") {
          // this is chaos, basically it is just there to capitalize the first
          // letter of every word that is not an initial HTTP and strip HTTP
          // code from przemek
          $key = str_replace(
            " ",
            "-",
            ucwords(strtolower(str_replace("_", " ", substr($key, 5))))
          );
          $out[$key] = $value;
        }
      }
      return $out;
    }
  
    // This function takes a input like a=b&a=c&d=e and returns the parsed
    // parameters like this
    // array('a' => array('b','c'), 'd' => 'e')
    public static function parse_parameters( $input ) {
      if (!isset($input) || !$input) return array();
  
      $pairs = split('&', $input);
  
      $parsed_parameters = array();
      foreach ($pairs as $pair) {
        $split = split('=', $pair, 2);
        $parameter = OAuthUtil::urldecode_rfc3986($split[0]);
        $value = isset($split[1]) ? OAuthUtil::urldecode_rfc3986($split[1]) : '';
  
        if (isset($parsed_parameters[$parameter])) {
          // We have already recieved parameter(s) with this name, so add to the list
          // of parameters with this name
  
          if (is_scalar($parsed_parameters[$parameter])) {
            // This is the first duplicate, so transform scalar (string) into an array
            // so we can add the duplicates
            $parsed_parameters[$parameter] = array($parsed_parameters[$parameter]);
          }
  
          $parsed_parameters[$parameter][] = $value;
        } else {
          $parsed_parameters[$parameter] = $value;
        }
      }
      return $parsed_parameters;
    }
  
    public static function build_http_query($params) {
      if (!$params) return '';
  
      // Urlencode both keys and values
      $keys = OAuthUtil::urlencode_rfc3986(array_keys($params));
      $values = OAuthUtil::urlencode_rfc3986(array_values($params));
      $params = array_combine($keys, $values);
  
      // Parameters are sorted by name, using lexicographical byte value ordering.
      // Ref: Spec: 9.1.1 (1)
      uksort($params, 'strcmp');
  
      $pairs = array();
      foreach ($params as $parameter => $value) {
        if (is_array($value)) {
          // If two or more parameters share the same name, they are sorted by their value
          // Ref: Spec: 9.1.1 (1)
          natsort($value);
          foreach ($value as $duplicate_value) {
            $pairs[] = $parameter . '=' . $duplicate_value;
          }
        } else {
          $pairs[] = $parameter . '=' . $value;
        }
      }
      // For each parameter, the name is separated from the corresponding value by an '=' character (ASCII code 61)
      // Each name-value pair is separated by an '&' character (ASCII code 38)
      return implode('&', $pairs);
    }
  }

  class PesaPal
  {
      public static $env = 'sandbox';
      public static $consumer_key;
      public static $consumer_secret;
      
      function config( $env, $consumer_key, $consumer_secret, $callback_url )
      {
          self::$env 				= $env;
          self::$consumer_key 	= $consumer_key;
          self::$consumer_secret 	= $consumer_secret;
          self::$callback_url 	= $callback_url;

          self::iframe();
      }

      public static function iframe( $params = NULL )
      {
          //pesapal params
          $token 			= $params = NULL;
          $sign_method 	= new OAuthSignatureMethod_HMAC_SHA1();
          $iframelink 	= self::$env == 'sandbox' ? 'https://demo.pesapal.com/api/PostPesapalDirectOrderV4' : 'https://pesapal.com/api/PostPesapalDirectOrderV4';

          $amount 		= number_format( $_POST['amount'], 2 );
          $desc 			= $_POST['description'];
          $type 			= $_POST['type'];
          $reference 		= $_POST['reference'];
          $first_name 	= $_POST['first_name'];
          $last_name 		= $_POST['last_name'];
          $email 			= $_POST['email'];
          $phonenumber 	= '';

          $post_xml 		= '<?xml version="1.0" encoding="utf-8"?><PesapalDirectOrderInfo xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="https://www.w3.org/2001/XMLSchema" Amount='.$amount.' Description='.$desc.' Type='.$type.' Reference='.$reference.' FirstName='.$first_name.' LastName='.$last_name.' Email='.$email.' PhoneNumber='.$phonenumber.' xmlns="https://www.pesapal.com" />';
          $post_xml 		= htmlentities($post_xml);

          $consumer 		= new OAuthConsumer( self::$consumer_key, self::$consumer_secret);

          //post transaction to pesapal
          $iframe_src 	= OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
          $iframe_src->set_parameter("oauth_callback", self::$callback_url);
          $iframe_src->set_parameter("pesapal_request_data", $post_xml);
          $iframe_src->sign_request($sign_method, $consumer, $token);

          //display pesapal - iframe and pass iframe_src
          ?>
          <iframe src="<?php echo $iframe_src;?>" width="100%" height="700px"  scrolling="no" frameBorder="0">
              <p>Browser unable to load iFrame</p>
          </iframe> <?php
      }

      public static function process_ipn( $callback = null )
      {
          $statusrequestAPI = self::$env == 'sandbox' ? 'https://demo.pesapal.com/api/querypaymentstatus' : 'https://pesapal.com/api/querypaymentstatus';

          // Parameters sent to you by PesaPal IPN
          $pesapalNotification 			= $_GET['pesapal_notification_type'];
          $pesapalTrackingId 				= $_GET['pesapal_transaction_tracking_id'];
          $pesapal_merchant_reference 	= $_GET['pesapal_merchant_reference'];

          if( $pesapalNotification == "CHANGE" && $pesapalTrackingId!='' ) {
             $token = $params = NULL;
             $consumer = new OAuthConsumer($consumer_key, $consumer_secret);
             $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

             //get transaction status
             $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);
             $request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);
             $request_status->set_parameter("pesapal_transaction_tracking_id",$pesapalTrackingId);
             $request_status->sign_request($signature_method, $consumer, $token);

             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $request_status);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_HEADER, 1);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

             if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True')
             {
                $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
                curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
                curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
                curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
             }

             $response = curl_exec($ch);

             $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
             $raw_header  = substr($response, 0, $header_size - 4);
             $headerArray = explode("\r\n\r\n", $raw_header);
             $header      = $headerArray[count($headerArray) - 1];

             //transaction status
             $elements = preg_split("/=/",substr($response, $header_size));
             $status = $elements[1];

             curl_close ($ch);
             
             //UPDATE YOUR DB TABLE WITH NEW STATUS FOR TRANSACTION WITH pesapal_transaction_tracking_id $pesapalTrackingId

             if( call_user_func_array( $callback, $response ) )
             {
                $response = array(
                    "code" => 0,
                    "message" => "pesapal_notification_type=$pesapalNotification&pesapal_transaction_tracking_id=$pesapalTrackingId&pesapal_merchant_reference=$pesapal_merchant_reference"
                );

                exit( json_decode( $response ) );
             }
          }
      }


}
