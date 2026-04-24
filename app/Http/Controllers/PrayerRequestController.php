<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrayerRequestController extends Controller
{
    public function index()
    {
        return Inertia::render('PrayerRequests', [
            'publicRequests' => PrayerRequest::query()
                ->where('is_private', false)
                ->latest()
                ->limit(20)
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        PrayerRequest::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'request' => ['required', 'string', 'max:5000'],
            'is_private' => ['boolean'],
        ]));

        return back()->with('success', 'Prayer request submitted successfully.');
    }
}
