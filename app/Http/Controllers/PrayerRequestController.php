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
            'request_text' => ['required', 'string', 'min:5'],
            'is_private' => ['boolean'],
        ]);

        $data['is_private'] = $request->boolean('is_private', true);

        PrayerRequest::create($data);

        return back();
    }
}
