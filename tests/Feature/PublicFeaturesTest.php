<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Sermon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_dynamic_pages_load(): void
    {
        $this->withoutVite();

        Sermon::query()->create([
            'title' => 'Faith in Action',
            'slug' => 'faith-in-action',
            'speaker' => 'Pastor Daniel',
            'preached_at' => now()->toDateString(),
            'excerpt' => 'Encouragement for today',
            'content' => 'Full sermon content',
            'is_published' => true,
        ]);

        Event::query()->create([
            'title' => 'Community Night',
            'slug' => 'community-night',
            'description' => 'Family event',
            'location' => 'Main Hall',
            'starts_at' => now()->addDay(),
            'is_published' => true,
        ]);

        $this->get('/blog')->assertOk();
        $this->get('/events')->assertOk();
        $this->get('/donate')->assertOk();
        $this->get('/prayer-requests')->assertOk();
    }
}
