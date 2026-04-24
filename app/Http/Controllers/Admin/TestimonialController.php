<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Testimonials/Index', [
            'testimonials' => Testimonial::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Testimonials/Create');
    }

    public function store(Request $request)
    {
        Testimonial::create($this->validatedData($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return Inertia::render('Admin/Testimonials/Edit', [
            'testimonial' => $testimonial,
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validatedData($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'Testimonial deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'is_published' => ['boolean'],
        ]);
    }
}
