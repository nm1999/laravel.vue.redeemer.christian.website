<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\HomeGalleryImage;
use App\Models\LiveStream;
use App\Models\Sermon;
use App\Models\SiteSettings;
use App\Models\ChurchLeader;

class ApiController extends Controller
{
    public function homepageData(){
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

    public function churchleaders(){
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

    public function gallery(){
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

    public function events(){
        return response()->json([
            'events' => Event::query()->orderBy('starts_at')->get(),
        ]);
    }
}
