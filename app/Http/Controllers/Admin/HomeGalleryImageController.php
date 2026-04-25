<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeGalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HomeGalleryImageController extends Controller
{
    public function index(Request $request): Response|JsonResponse
    {
        $homeGalleryImages = HomeGalleryImage::query()
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->map(fn (HomeGalleryImage $homeGalleryImage) => $this->formatHomeGalleryImage($homeGalleryImage))
            ->values();

        if ($request->wantsJson()) {
            return response()->json(['data' => $homeGalleryImages]);
        }

        return Inertia::render('Admin/HomeGalleryImages/Index', [
            'homeGalleryImages' => $homeGalleryImages,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/HomeGalleryImages/Create');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'max:4096'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $data['image'] = $request->file('image')->store('home-gallery', 'public');

        $homeGalleryImage = HomeGalleryImage::query()->create($data);

        if ($request->wantsJson()) {
            return response()->json($this->formatHomeGalleryImage($homeGalleryImage), 201);
        }

        return to_route('admin.home-gallery-images.index');
    }

    public function edit(HomeGalleryImage $homeGalleryImage): Response
    {
        return Inertia::render('Admin/HomeGalleryImages/Edit', [
            'homeGalleryImage' => $this->formatHomeGalleryImage($homeGalleryImage),
        ]);
    }

    public function update(Request $request, HomeGalleryImage $homeGalleryImage): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homeGalleryImage->image);
            $data['image'] = $request->file('image')->store('home-gallery', 'public');
        }

        $homeGalleryImage->update($data);

        if ($request->wantsJson()) {
            return response()->json($this->formatHomeGalleryImage($homeGalleryImage->fresh()));
        }

        return to_route('admin.home-gallery-images.index');
    }

    public function destroy(Request $request, HomeGalleryImage $homeGalleryImage): RedirectResponse|JsonResponse
    {
        Storage::disk('public')->delete($homeGalleryImage->image);
        $homeGalleryImage->delete();

        if ($request->wantsJson()) {
            return response()->json([], 204);
        }

        return to_route('admin.home-gallery-images.index');
    }

    private function formatHomeGalleryImage(HomeGalleryImage $homeGalleryImage): array
    {
        return [
            'id' => $homeGalleryImage->id,
            'image' => $homeGalleryImage->image,
            'image_url' => $homeGalleryImage->image_url,
            'order' => $homeGalleryImage->order,
            'is_active' => $homeGalleryImage->is_active,
        ];
    }
}