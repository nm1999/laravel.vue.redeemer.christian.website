<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Event;
use App\Models\PrayerRequest;
use App\Models\Sermon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'sermons' => Sermon::count(),
                'events' => Event::count(),
                'donations' => Donation::count(),
                'pendingPrayerRequests' => PrayerRequest::where('status', 'new')->count(),
            ],
        ]);
    }
}
