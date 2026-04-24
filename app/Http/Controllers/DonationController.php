<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\StripeClient;

class DonationController extends Controller
{
    public function index()
    {
        return Inertia::render('Donate', [
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

    public function createIntent(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! config('services.stripe.secret')) {
            return back()->withErrors(['amount' => 'Stripe is not configured yet.']);
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $intent = $stripe->paymentIntents->create([
            'amount' => (int) round($data['amount'] * 100),
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
            'receipt_email' => $data['email'],
            'metadata' => ['name' => $data['name']],
        ]);

        Donation::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'currency' => 'usd',
            'stripe_payment_intent_id' => $intent->id,
            'status' => $intent->status,
            'message' => $data['message'] ?? null,
        ]);

        return back()->with('success', 'Donation intent created. Complete payment in Stripe checkout flow.');
    }

    public function success()
    {
        return Inertia::render('Donate', [
            'stripeKey' => config('services.stripe.key'),
            'status' => 'success',
        ]);
    }
}
