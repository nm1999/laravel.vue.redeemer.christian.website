<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PrayerRequestController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('PrayerRequests');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'request_text' => ['required', 'string', 'min:5'],
            'is_private' => ['boolean'],
        ]);

        $data['is_private'] = $request->boolean('is_private', true);

        PrayerRequest::create($data);

        return back()->with('success', 'Your message has been sent successfully. Our team will get back to you soon.');
    }
}
