<?php

namespace Tests\Feature;

use App\Models\HomeGalleryImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomeGalleryImageManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_home_gallery_image(): void
    {
        $this->withoutVite();

        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/home-gallery-images', [
            'image' => UploadedFile::fake()->image('gallery.jpg'),
            'order' => 1,
            'is_active' => true,
        ]);

        $response->assertRedirect('/admin/home-gallery-images');

        $this->assertDatabaseHas('home_gallery_images', [
            'order' => 1,
            'is_active' => true,
        ]);

        $homeGalleryImage = HomeGalleryImage::query()->firstOrFail();
        Storage::disk('public')->assertExists($homeGalleryImage->image);
    }

    public function test_home_page_receives_active_gallery_images_in_display_order(): void
    {
        $this->withoutVite();

        HomeGalleryImage::query()->create([
            'image' => 'home-gallery/second.jpg',
            'order' => 2,
            'is_active' => true,
        ]);

        HomeGalleryImage::query()->create([
            'image' => 'home-gallery/hidden.jpg',
            'order' => 0,
            'is_active' => false,
        ]);

        HomeGalleryImage::query()->create([
            'image' => 'home-gallery/first.jpg',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertInertia(fn ($page) => $page
                ->component('Home')
                ->where('homeGalleryImages.0', '/storage/home-gallery/first.jpg')
                ->where('homeGalleryImages.1', '/storage/home-gallery/second.jpg')
                ->missing('homeGalleryImages.2')
            );
    }
}