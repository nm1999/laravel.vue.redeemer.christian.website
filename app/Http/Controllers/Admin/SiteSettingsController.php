<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Admin/SiteSettings', [
            'settings' => SiteSettings::query()->first(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'mission'          => ['nullable', 'string', 'max:2000'],
            'vision'           => ['nullable', 'string', 'max:2000'],
            'email'            => ['nullable', 'email', 'max:255'],
            'location'         => ['nullable', 'string', 'max:512'],
            'whatsapp_number'  => ['nullable', 'string', 'max:30'],
            'youtube_live_url' => ['nullable', 'url', 'max:512'],
            'intro_video_url'  => ['nullable', 'url', 'max:512'],
        ]);

        SiteSettings::query()->updateOrCreate(
            ['id' => SiteSettings::query()->value('id')],
            $data
        );

        return back()->with('success', 'Settings saved.');
    }
}
