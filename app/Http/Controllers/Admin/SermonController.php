<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SermonController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Sermons/Index', [
            'sermons' => Sermon::query()->latest('preached_at')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Sermons/Create');
    }

    public function store(Request $request)
    {
        Sermon::create($this->validatedData($request));

        return redirect()->route('admin.sermons.index')->with('success', 'Sermon created successfully.');
    }

    public function edit(Sermon $sermon)
    {
        return Inertia::render('Admin/Sermons/Edit', [
            'sermon' => $sermon,
        ]);
    }

    public function update(Request $request, Sermon $sermon)
    {
        $sermon->update($this->validatedData($request, $sermon));

        return redirect()->route('admin.sermons.index')->with('success', 'Sermon updated successfully.');
    }

    public function destroy(Sermon $sermon)
    {
        $sermon->delete();

        return back()->with('success', 'Sermon deleted successfully.');
    }

    private function validatedData(Request $request, ?Sermon $sermon = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('sermons', 'slug')->ignore($sermon)],
            'speaker' => ['required', 'string', 'max:255'],
            'preached_at' => ['required', 'date'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'video_url' => ['nullable', 'url', 'max:2048'],
            'is_published' => ['boolean'],
        ]);
    }
}
