<?php

namespace App\Http\Controllers;

use App\Models\ChurchLeader;
use App\Models\Event;
use App\Models\Sermon;
use App\Models\HeroSlide;
use App\Models\HomeGalleryImage;
use App\Models\LiveStream;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function homepageData()
    {
        return response()->json([
            'featuredEvents' => Event::query()
                ->where('starts_at', '>=', now())
                ->orderBy('starts_at')
                ->limit(3)
                ->get(),
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
    }

    public function churchleaders()
    {
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
                ])->values(),
        ]);
    }

    public function gallery()
    {
        return response()->json([
            'homeGalleryImages' => HomeGalleryImage::query()
                ->where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
                ->get()
                ->map(fn (HomeGalleryImage $homeGalleryImage) => $homeGalleryImage->image_url)
                ->values(),
        ]);
    }

    public function events()
    {
        return response()->json([
            'events' => Event::query()->orderBy('starts_at')->get(),
        ]);
    }

    public function siteSettings()
    {
        return response()->json([
            'siteSettings' => SiteSettings::query()->first(),
        ]);
    }

    public function activities(){
        $resolveImagePath = static function (?string $path): string {
            if (! $path) {
                return '/images/1.jpg';
            }

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
                return $path;
            }

          return Storage::disk('public')->url($path);
        };

        return response()->json([
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
    }
}
