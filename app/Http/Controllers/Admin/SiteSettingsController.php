<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'facebook_url'     => ['nullable', 'url', 'max:512'],
            'youtube_url'      => ['nullable', 'url', 'max:512'],
            'twitter_url'      => ['nullable', 'url', 'max:512'],
            'site_name'        => ['nullable', 'string', 'max:255'],
            'site_favicon'     => ['nullable', 'image', 'max:2048'],
        ]);

        $settings = SiteSettings::query()->first();

        if ($request->hasFile('site_favicon')) {
            if ($settings?->site_favicon_url && ! self::isExternalUrl($settings->site_favicon_url)) {
                Storage::disk('public')->delete($settings->site_favicon_url);
            }

            $data['site_favicon_url'] = $request->file('site_favicon')->store('branding', 'public');
        }

        SiteSettings::query()->updateOrCreate(
            ['id' => $settings?->id],
            $data
        );

        return back()->with('success', 'Settings saved.');
    }

    private static function isExternalUrl(string $value): bool
    {
        return str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '/');
    }
}
