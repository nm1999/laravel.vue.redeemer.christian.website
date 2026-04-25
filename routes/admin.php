<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ChurchLeaderController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\LiveStreamController;
use App\Http\Controllers\Admin\SermonController;
use App\Models\PrayerRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('sermons', SermonController::class)->except(['show']);
    Route::resource('events', EventController::class)->except(['show']);
    Route::resource('church-leaders', ChurchLeaderController::class);
    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);

    Route::get('/live-stream', [LiveStreamController::class, 'edit'])->name('live-stream.edit');
    Route::put('/live-stream', [LiveStreamController::class, 'update'])->name('live-stream.update');

    Route::get('/prayer-requests', function () {
        return Inertia::render('Admin/PrayerRequests', [
            'prayerRequests' => PrayerRequest::query()->latest()->get(),
        ]);
    })->name('prayer-requests.index');
});
