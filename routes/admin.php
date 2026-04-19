<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LiveStreamController;
use App\Http\Controllers\Admin\PrayerRequestController;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    Route::resource('sermons', SermonController::class)->except(['show']);
    Route::resource('events', EventController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    Route::get('/live-stream', [LiveStreamController::class, 'edit'])->name('live-stream.edit');
    Route::put('/live-stream', [LiveStreamController::class, 'update'])->name('live-stream.update');

    Route::get('/prayer-requests', [PrayerRequestController::class, 'index'])->name('prayer-requests.index');
    Route::put('/prayer-requests/{prayerRequest}', [PrayerRequestController::class, 'update'])->name('prayer-requests.update');
});
