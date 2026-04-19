<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveStream;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LiveStreamController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Admin/LiveStream', [
            'liveStream' => LiveStream::query()->first(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'platform' => ['required', 'string', 'max:50'],
            'embed_url' => ['required', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        LiveStream::query()->updateOrCreate(
            ['id' => LiveStream::query()->value('id')],
            [
                'platform' => $data['platform'],
                'embed_url' => $data['embed_url'],
                'is_active' => $request->boolean('is_active', true),
            ]
        );

        return back();
    }
}
