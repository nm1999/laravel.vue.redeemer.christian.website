<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class SermonController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Sermons/Index', [
            'sermons' => Sermon::latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Sermons/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'preached_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));
        $data['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('sermons', 'public');
        }

        Sermon::create($data);

        return redirect('/admin/sermons')->with('success', 'Sermon created successfully.');
    }

    public function edit(Sermon $sermon): Response
    {
        return Inertia::render('Admin/Sermons/Edit', [
            'sermon' => $sermon,
        ]);
    }

    public function update(Request $request, Sermon $sermon): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'preached_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ]);

        if ($sermon->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));
        }

        $data['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            if ($sermon->image_path && ! self::isExternalUrl($sermon->image_path)) {
                Storage::disk('public')->delete($sermon->image_path);
            }

            $data['image_path'] = $request->file('image')->store('sermons', 'public');
        }

        $sermon->update($data);

        return redirect('/admin/sermons')->with('success', 'Sermon updated successfully.');
    }

    public function destroy(Sermon $sermon): RedirectResponse
    {
        if ($sermon->image_path && ! self::isExternalUrl($sermon->image_path)) {
            Storage::disk('public')->delete($sermon->image_path);
        }

        $sermon->delete();

        return redirect('/admin/sermons')->with('success', 'Sermon deleted.');
    }

    private static function isExternalUrl(string $value): bool
    {
        return str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '/');
    }
}
