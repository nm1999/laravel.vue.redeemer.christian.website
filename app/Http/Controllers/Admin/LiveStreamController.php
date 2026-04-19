<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveStream;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LiveStreamController extends Controller
{
    public function edit()
    {
        return Inertia::render('Admin/LiveStream', [
            'liveStream' => LiveStream::query()->first(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'platform' => ['required', 'in:youtube,facebook,custom'],
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'is_active' => ['boolean'],
        ]);

        $data['embed_url'] = $this->embedUrl($data['platform'], $data['url']);

        LiveStream::query()->updateOrCreate(['id' => optional(LiveStream::query()->first())->id], $data);

        return back()->with('success', 'Live stream updated successfully.');
    }

    private function embedUrl(string $platform, string $url): string
    {
        if ($platform === 'youtube' && preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        if ($platform === 'facebook') {
            return 'https://www.facebook.com/plugins/video.php?href='.urlencode($url).'&show_text=false';
        }

        return $url;
    }
}
