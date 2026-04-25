<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HeroSlideController extends Controller
{
    public function index(Request $request): Response|JsonResponse
    {
        $heroSlides = HeroSlide::query()
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->map(fn (HeroSlide $heroSlide) => $this->formatHeroSlide($heroSlide))
            ->values();

        if ($request->wantsJson()) {
            return response()->json(['data' => $heroSlides]);
        }

        return Inertia::render('Admin/HeroSlides/Index', [
            'heroSlides' => $heroSlides,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/HeroSlides/Create');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'kicker' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'max:4096'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $data['image'] = $request->file('image')->store('hero-slides', 'public');

        $heroSlide = HeroSlide::query()->create($data);

        if ($request->wantsJson()) {
            return response()->json($this->formatHeroSlide($heroSlide), 201);
        }

        return to_route('admin.hero-slides.index');
    }

    public function edit(HeroSlide $heroSlide): Response
    {
        return Inertia::render('Admin/HeroSlides/Edit', [
            'heroSlide' => $this->formatHeroSlide($heroSlide),
        ]);
    }

    public function update(Request $request, HeroSlide $heroSlide): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'kicker' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($heroSlide->image);
            $data['image'] = $request->file('image')->store('hero-slides', 'public');
        }

        $heroSlide->update($data);

        if ($request->wantsJson()) {
            return response()->json($this->formatHeroSlide($heroSlide->fresh()));
        }

        return to_route('admin.hero-slides.index');
    }

    public function destroy(Request $request, HeroSlide $heroSlide): RedirectResponse|JsonResponse
    {
        Storage::disk('public')->delete($heroSlide->image);
        $heroSlide->delete();

        if ($request->wantsJson()) {
            return response()->json([], 204);
        }

        return to_route('admin.hero-slides.index');
    }

    private function formatHeroSlide(HeroSlide $heroSlide): array
    {
        return [
            'id' => $heroSlide->id,
            'kicker' => $heroSlide->kicker,
            'title' => $heroSlide->title,
            'description' => $heroSlide->description,
            'image' => $heroSlide->image,
            'image_url' => $heroSlide->image_url,
            'order' => $heroSlide->order,
            'is_active' => $heroSlide->is_active,
        ];
    }
}