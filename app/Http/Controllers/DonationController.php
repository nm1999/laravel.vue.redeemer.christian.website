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
}
