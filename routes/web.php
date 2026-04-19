<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PrayerRequestController;
use App\Models\Event;
use App\Models\LiveStream;
use App\Models\Sermon;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'events' => Event::query()->where('is_published', true)->where('starts_at', '>=', now())->orderBy('starts_at')->limit(3)->get(),
        'latestSermons' => Sermon::query()->where('is_published', true)->latest('preached_at')->limit(3)->get(),
        'liveStream' => LiveStream::query()->where('is_active', true)->first(),
        'testimonials' => Testimonial::query()->where('is_published', true)->latest()->limit(3)->get(),
    ]);
})->name('home');

Route::redirect('/login', '/admin/login')->name('login');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/blog', function () {
    return Inertia::render('Blogs', [
        'posts' => Sermon::query()->where('is_published', true)->latest('preached_at')->get(),
    ]);
})->name('blog.index');

Route::get('/blog/{slug}', function (string $slug) {
    $post = Sermon::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

    return Inertia::render('BlogPost', ['post' => $post]);
})->name('blog.show');

Route::get('/events', function () {
    return Inertia::render('Events', [
        'events' => Event::query()->where('is_published', true)->orderBy('starts_at')->get(),
    ]);
})->name('events.index');

Route::get('/events/{slug}', function (string $slug) {
    return Inertia::render('Events', [
        'events' => Event::query()->where('is_published', true)->where('slug', $slug)->get(),
        'focusedSlug' => $slug,
    ]);
})->name('events.show');

Route::get('/prayer-requests', [PrayerRequestController::class, 'index'])->name('prayer-requests.index');
Route::post('/prayer-requests', [PrayerRequestController::class, 'store'])->name('prayer-requests.store');

Route::get('/donate', [DonationController::class, 'index'])->name('donate.index');
Route::post('/donate/intent', [DonationController::class, 'createIntent'])->name('donate.intent');
Route::get('/donate/success', [DonationController::class, 'success'])->name('donate.success');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

require __DIR__.'/admin.php';
