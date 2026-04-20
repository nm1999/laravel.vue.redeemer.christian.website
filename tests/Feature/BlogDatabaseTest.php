<?php

namespace Tests\Feature;

use App\Models\Sermon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_page_reads_sermons_from_database(): void
    {
        $this->withoutVite();

        Sermon::query()->create([
            'title' => 'Grace in Action',
            'slug' => 'grace-in-action',
            'excerpt' => 'Encouragement for the week.',
            'content' => 'Content body',
            'speaker' => 'Pastor John',
            'preached_at' => now(),
            'is_published' => true,
        ]);

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee('Grace in Action');
    }
}
