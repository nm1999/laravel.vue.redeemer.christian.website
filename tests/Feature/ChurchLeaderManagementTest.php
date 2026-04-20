<?php

namespace Tests\Feature;

use App\Models\ChurchLeader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ChurchLeaderManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_church_leader_with_image_upload(): void
    {
        $this->withoutVite();

        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/church-leaders', [
            'name' => 'Pastor Jane Doe',
            'title' => 'Senior Pastor',
            'image' => UploadedFile::fake()->image('leader.jpg'),
            'bio' => 'Serves the community with compassion.',
            'order' => 1,
        ]);

        $response->assertRedirect('/admin/church-leaders');

        $this->assertDatabaseHas('church_leaders', [
            'name' => 'Pastor Jane Doe',
            'title' => 'Senior Pastor',
            'order' => 1,
        ]);

        $leader = ChurchLeader::query()->firstOrFail();
        Storage::disk('public')->assertExists($leader->image);
    }

    public function test_church_leader_api_returns_leaders_in_display_order(): void
    {
        $this->withoutVite();

        ChurchLeader::query()->create([
            'name' => 'Leader B',
            'title' => 'Associate Pastor',
            'image' => 'church-leaders/leader-b.jpg',
            'bio' => null,
            'order' => 2,
        ]);

        ChurchLeader::query()->create([
            'name' => 'Leader A',
            'title' => 'Senior Pastor',
            'image' => 'church-leaders/leader-a.jpg',
            'bio' => 'Bio for leader A',
            'order' => 1,
        ]);

        $response = $this->getJson('/api/church-leaders');

        $response
            ->assertOk()
            ->assertJsonPath('data.0.name', 'Leader A')
            ->assertJsonPath('data.1.name', 'Leader B');
    }
}
