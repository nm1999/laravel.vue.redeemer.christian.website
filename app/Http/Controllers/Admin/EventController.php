<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Events/Index', [
            'events' => Event::orderBy('starts_at')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Events/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_featured' => ['boolean'],
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));
        $data['is_featured'] = $request->boolean('is_featured', false);

        Event::create($data);

        return to_route('admin.events.index');
    }

    public function edit(Event $event): Response
    {
        return Inertia::render('Admin/Events/Edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_featured' => ['boolean'],
        ]);

        if ($event->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));
        }

        $data['is_featured'] = $request->boolean('is_featured', false);

        $event->update($data);

        return to_route('admin.events.index');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return to_route('admin.events.index');
    }
}
