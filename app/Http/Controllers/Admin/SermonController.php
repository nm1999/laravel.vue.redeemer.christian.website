<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'image_path' => ['nullable', 'string', 'max:255'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'preached_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));
        $data['is_published'] = $request->boolean('is_published', true);

        Sermon::create($data);

        return to_route('admin.sermons.index');
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
            'image_path' => ['nullable', 'string', 'max:255'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'preached_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ]);

        if ($sermon->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));
        }

        $data['is_published'] = $request->boolean('is_published', true);

        $sermon->update($data);

        return to_route('admin.sermons.index');
    }

    public function destroy(Sermon $sermon): RedirectResponse
    {
        $sermon->delete();

        return to_route('admin.sermons.index');
    }
}
