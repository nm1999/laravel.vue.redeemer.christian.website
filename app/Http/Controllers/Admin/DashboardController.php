<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\PrayerRequest;
use App\Models\Sermon;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'sermons' => Sermon::count(),
                'events' => Event::count(),
                'visitors' => User::count(),
                'prayerRequests' => PrayerRequest::count(),
            ],
        ]);
    }
}
