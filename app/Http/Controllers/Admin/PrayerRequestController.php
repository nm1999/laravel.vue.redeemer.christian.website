<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrayerRequestController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/PrayerRequests', [
            'requests' => PrayerRequest::query()->latest()->get(),
        ]);
    }

    public function update(Request $request, PrayerRequest $prayerRequest)
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,reviewed,prayed'],
        ]);

        $prayerRequest->update([
            'status' => $data['status'],
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Prayer request updated.');
    }
}
