<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\PesapalController;
use App\Models\ChurchLeader;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\HomeGalleryImage;
use App\Models\LiveStream;
use App\Models\Sermon;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'featuredEvents' => Event::query()->where('starts_at', '>=', now())->orderBy('starts_at')->limit(3)->get(),
        'heroSlides' => HeroSlide::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->map(fn (HeroSlide $heroSlide) => [
                'image' => $heroSlide->image_url,
                'kicker' => $heroSlide->kicker,
                'title' => $heroSlide->title,
                'description' => $heroSlide->description,
            ])
            ->values(),
        'homeGalleryImages' => HomeGalleryImage::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->limit(6)
            ->get()
            ->map(fn (HomeGalleryImage $homeGalleryImage) => $homeGalleryImage->image_url)
            ->values(),
        'activeLiveStream' => LiveStream::query()->where('is_active', true)->first(),
        'siteSettings' => SiteSettings::query()->first(),
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
Route::get('/gallery', fn () => Inertia::render('Gallery',[
    'homeGalleryImages' => HomeGalleryImage::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->map(fn (HomeGalleryImage $homeGalleryImage) => $homeGalleryImage->image_url)
            ->values(),
]))->name('gallery');

Route::get('/activities', function () {
    $resolveImagePath = static function (?string $path): string {
        if (! $path) {
            return '/images/1.jpg';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    };

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
                'image' => $resolveImagePath($sermon->image_path),
                'body1' => $sermon->content,
                'body2' => null,
            ]),
    ]);
})->name('blog.index');

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

Route::get('/contact', function () {
    return Inertia::render('Contact', [
        'siteSettings' => \App\Models\SiteSettings::query()->first(['email', 'location']),
    ]);
})->name('contact');

Route::get('/prayer-requests', [PrayerRequestController::class, 'create'])->name('prayer-requests.create');
Route::post('/prayer-requests', [PrayerRequestController::class, 'store'])->name('prayer-requests.store');

Route::get('/donate', [PesapalController::class, 'index'])->name('donate.index');
Route::get('/initiate-payment', fn () => redirect()->route('donate.index'))
    ->name('donate.redirect');
Route::post('/initiate-payment', [PesapalController::class, 'createPayment'])
    ->name('donate.store')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
Route::get('/api/site-details', function(){
    return SiteSettings::first();
});

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::get('/storage-link', function () {
    $storageBase = storage_path('app/public');
    $publicBase  = public_path('storage');

    // If public/storage is already a real directory (not a symlink), sync files into it
    // This is needed on servers that don't follow symlinks
    if (is_dir($publicBase) && ! is_link($publicBase)) {
        $copied = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($storageBase, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            $dest = $publicBase . DIRECTORY_SEPARATOR . $iterator->getSubPathname();
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
            'mode'    => 'copy',
        ]);
    }

    // Fallback: try to create symlink
    Artisan::call('storage:link');

    return response()->json([
        'message' => 'Storage link command executed.',
        'output'  => trim(Artisan::output()),
        'mode'    => 'symlink',
    ]);
})->name('storage.link');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
