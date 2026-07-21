<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PesapalController;
use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\ApiController;
use App\Models\ChurchLeader;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\HomeGalleryImage;
use App\Models\LiveStream;
use App\Models\Sermon;
use App\Models\SiteSettings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('home');
Route::get('/about', fn () => Inertia::render('About'))->name('about');
Route::get('/gallery', fn () => Inertia::render('Gallery'))->name('gallery');
Route::get('/events', fn () => Inertia::render('Events'))->name('events.index');
Route::get('/contact', fn () => Inertia::render('Contact'))->name('contact');
Route::get('/activities', fn ()=>Inertia::render('Blogs'))->name('blog.index');

Route::get('/blog/{sermon:slug}', function (Sermon $sermon) {
    $resolveImagePath = static function (?string $path): string {
        if (! $path) {
            return '/images/1.jpg';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    };

    return Inertia::render('BlogPost', [
        'post' => [
            'slug' => $sermon->slug,
            'title' => $sermon->title,
            'excerpt' => $sermon->excerpt,
            'date' => optional($sermon->preached_at)->format('F j, Y'),
            'author' => $sermon->speaker,
            'image' => $resolveImagePath($sermon->image_path),
            'body1' => $sermon->content,
            'body2' => null,
        ],
    ]);
})->name('blog.show');



Route::get('/events/{event:slug}', function (Event $event) {
    return Inertia::render('Events', [
        'events' => Event::query()->orderBy('starts_at')->get(),
        'selectedEvent' => $event,
    ]);
})->name('events.show');



Route::get('/prayer-requests', [PrayerRequestController::class, 'create'])->name('prayer-requests.create');
Route::post('/prayer-requests', [PrayerRequestController::class, 'store'])->name('prayer-requests.store');

Route::get('/donate', [PesapalController::class, 'index'])->name('donate.index');
Route::get('/initiate-payment', fn () => redirect()->route('donate.index'))
    ->name('donate.redirect');
Route::post('/initiate-payment', [PesapalController::class, 'createPayment'])
    ->name('donate.store')
    ->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/api/site-details', function () {
    return SiteSettings::first();
});

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::prefix('api')->group(function () {
    Route::get('/home-page-data',[ApiController::class,'homepageData'])->name('api.home');
    Route::get('/church-leaders',[ApiController::class, 'churchleaders'])->name('church-leaders.index');
    Route::get('/gallery',[ApiController::class, 'gallery'])->name('fetch.gallery');
    Route::get('/events',[ApiController::class, 'events'])->name('fetch.events');
    Route::get('/site-settings',[ApiController::class, 'siteSettings'])->name('fetch.settings');
    Route::get('/activities',[ApiController::class, 'activities'])->name('fetch.activities');
});

Route::get('/storage-link', function () {
    $storageBase = storage_path('app/public');
    $publicBase = public_path('storage');

    // If public/storage is already a real directory (not a symlink), sync files into it
    // This is needed on servers that don't follow symlinks
    if (is_dir($publicBase) && ! is_link($publicBase)) {
        $copied = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($storageBase, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            $dest = $publicBase.DIRECTORY_SEPARATOR.$iterator->getSubPathname();
            if ($item->isDir()) {
                if (! is_dir($dest)) {
                    mkdir($dest, 0755, true);
                }
            } else {
                copy($item->getPathname(), $dest);
                $copied++;
            }
        }

        return response()->json([
            'message' => "Copied {$copied} file(s) from storage to public/storage.",
            'mode' => 'copy',
        ]);
    }

    // Fallback: try to create symlink
    Artisan::call('storage:link');

    return response()->json([
        'message' => 'Storage link command executed.',
        'output' => trim(Artisan::output()),
        'mode' => 'symlink',
    ]);
})->name('storage.link');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
