<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChurchLeader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ChurchLeaderController extends Controller
{
    public function index(Request $request): Response|JsonResponse
    {
        $churchLeaders = ChurchLeader::query()
            ->orderBy('order')
            ->orderBy('name')
            ->get()
            ->map(fn (ChurchLeader $churchLeader) => $this->formatChurchLeader($churchLeader))
            ->values();

        if ($request->wantsJson()) {
            return response()->json(['data' => $churchLeaders]);
        }

        return Inertia::render('Admin/ChurchLeaders/Index', [
            'churchLeaders' => $churchLeaders,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/ChurchLeaders/Create');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $data['image'] = $request->file('image')->store('church-leaders', 'public');

        $churchLeader = ChurchLeader::query()->create($data);

        if ($request->wantsJson()) {
            return response()->json($this->formatChurchLeader($churchLeader), 201);
        }

        return to_route('admin.church-leaders.index');
    }

    public function show(ChurchLeader $churchLeader): JsonResponse
    {
        return response()->json($this->formatChurchLeader($churchLeader));
    }

    public function edit(ChurchLeader $churchLeader): Response
    {
        return Inertia::render('Admin/ChurchLeaders/Edit', [
            'churchLeader' => $this->formatChurchLeader($churchLeader),
        ]);
    }

    public function update(Request $request, ChurchLeader $churchLeader): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($churchLeader->image);
            $data['image'] = $request->file('image')->store('church-leaders', 'public');
        }

        $churchLeader->update($data);

        if ($request->wantsJson()) {
            return response()->json($this->formatChurchLeader($churchLeader->fresh()));
        }

        return to_route('admin.church-leaders.index');
    }

    public function destroy(Request $request, ChurchLeader $churchLeader): RedirectResponse|JsonResponse
    {
        Storage::disk('public')->delete($churchLeader->image);
        $churchLeader->delete();

        if ($request->wantsJson()) {
            return response()->json([], 204);
        }

        return to_route('admin.church-leaders.index');
    }

    private function formatChurchLeader(ChurchLeader $churchLeader): array
    {
        return [
            'id' => $churchLeader->id,
            'name' => $churchLeader->name,
            'title' => $churchLeader->title,
            'image' => $churchLeader->image,
            'image_url' => $churchLeader->image_url,
            'bio' => $churchLeader->bio,
            'order' => $churchLeader->order,
        ];
    }
}
