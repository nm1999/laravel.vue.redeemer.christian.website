<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PrayerRequestController;
use App\Models\ChurchLeader;
use App\Models\Event;
use App\Models\LiveStream;
use App\Models\Sermon;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'featuredEvents' => Event::query()->where('starts_at', '>=', now())->orderBy('starts_at')->limit(3)->get(),
        'activeLiveStream' => LiveStream::query()->where('is_active', true)->first(),
    ]);
})->name('home');

Route::get('/api/church-leaders', function () {
    return response()->json([
        'data' => ChurchLeader::query()
            ->orderBy('order')
            ->orderBy('name')
            ->get()
            ->map(fn (ChurchLeader $churchLeader) => [
                'id' => $churchLeader->id,
                'name' => $churchLeader->name,
                'title' => $churchLeader->title,
                'image' => $churchLeader->image_url,
                'bio' => $churchLeader->bio,
                'order' => $churchLeader->order,
            ])
            ->values(),
    ]);
})->name('church-leaders.index');

Route::get('/about', fn () => Inertia::render('About'))->name('about');

Route::get('/blog', function () {
    return Inertia::render('Blogs', [
        'posts' => Sermon::query()
            ->where('is_published', true)
            ->latest('preached_at')
            ->get()
            ->map(fn (Sermon $sermon) => [
                'slug' => $sermon->slug,
                'title' => $sermon->title,
                'excerpt' => $sermon->excerpt,
                'date' => optional($sermon->preached_at)->format('F j, Y'),
                'author' => $sermon->speaker,
                'image' => $sermon->image_path ?: '/images/1.jpg',
                'body1' => $sermon->content,
                'body2' => null,
            ]),
    ]);
})->name('blog.index');

Route::get('/blog/{sermon:slug}', function (Sermon $sermon) {
    return Inertia::render('BlogPost', [
        'post' => [
            'slug' => $sermon->slug,
            'title' => $sermon->title,
            'excerpt' => $sermon->excerpt,
            'date' => optional($sermon->preached_at)->format('F j, Y'),
            'author' => $sermon->speaker,
            'image' => $sermon->image_path ?: '/images/1.jpg',
            'body1' => $sermon->content,
            'body2' => null,
        ],
    ]);
})->name('blog.show');

Route::get('/events', function () {
    return Inertia::render('Events', [
        'events' => Event::query()->orderBy('starts_at')->get(),
    ]);
})->name('events.index');

Route::get('/events/{event:slug}', function (Event $event) {
    return Inertia::render('Events', [
        'events' => Event::query()->orderBy('starts_at')->get(),
        'selectedEvent' => $event,
    ]);
})->name('events.show');

Route::get('/contact', fn () => Inertia::render('Contact'))->name('contact');

Route::get('/prayer-requests', [PrayerRequestController::class, 'create'])->name('prayer-requests.create');
Route::post('/prayer-requests', [PrayerRequestController::class, 'store'])->name('prayer-requests.store');

Route::get('/donate', [DonationController::class, 'create'])->name('donate.create');
Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');
Route::post('/donate/payment-intent', [DonationController::class, 'paymentIntent'])->name('donate.payment-intent');
Route::get('/donate/success', [DonationController::class, 'success'])->name('donate.success');
Route::get('/donate/failure', [DonationController::class, 'failure'])->name('donate.failure');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
