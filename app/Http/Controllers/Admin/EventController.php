<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Events/Index', [
            'events' => Event::query()->orderBy('starts_at')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Events/Create');
    }

    public function store(Request $request)
    {
        Event::create($this->validatedData($request));

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validatedData($request, $event));

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return back()->with('success', 'Event deleted successfully.');
    }

    private function validatedData(Request $request, ?Event $event = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('events', 'slug')->ignore($event)],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ]);
    }
}
