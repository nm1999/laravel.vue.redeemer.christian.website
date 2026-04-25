<?php

namespace Tests\Feature;

use App\Models\HeroSlide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeroSlideManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_hero_slide_with_image_upload(): void
    {
        $this->withoutVite();

        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/hero-slides', [
            'kicker' => 'Sunday Celebration',
            'title' => 'Church is family, not just an event.',
            'description' => 'Worship, community, and practical hope for every generation.',
            'image' => UploadedFile::fake()->image('slide.jpg'),
            'order' => 1,
            'is_active' => true,
        ]);

        $response->assertRedirect('/admin/hero-slides');

        $this->assertDatabaseHas('hero_slides', [
            'kicker' => 'Sunday Celebration',
            'title' => 'Church is family, not just an event.',
            'order' => 1,
            'is_active' => true,
        ]);

        $heroSlide = HeroSlide::query()->firstOrFail();
        Storage::disk('public')->assertExists($heroSlide->image);
    }

    public function test_home_page_receives_active_hero_slides_in_display_order(): void
    {
        $this->withoutVite();

        HeroSlide::query()->create([
            'kicker' => 'Second Slide',
            'title' => 'Second',
            'description' => 'Second description',
            'image' => 'hero-slides/second.jpg',
            'order' => 2,
            'is_active' => true,
        ]);

        HeroSlide::query()->create([
            'kicker' => 'Hidden Slide',
            'title' => 'Hidden',
            'description' => 'Hidden description',
            'image' => 'hero-slides/hidden.jpg',
            'order' => 0,
            'is_active' => false,
        ]);

        HeroSlide::query()->create([
            'kicker' => 'First Slide',
            'title' => 'First',
            'description' => 'First description',
            'image' => 'hero-slides/first.jpg',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertInertia(fn ($page) => $page
                ->component('Home')
                ->where('heroSlides.0.kicker', 'First Slide')
                ->where('heroSlides.1.kicker', 'Second Slide')
                ->missing('heroSlides.2')
            );
    }
}