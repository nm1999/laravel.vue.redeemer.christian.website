<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_accessible(): void
    {
        $this->withoutVite();

        $this->get('/admin/login')->assertOk();
    }

    public function test_non_admin_user_cannot_access_admin_dashboard(): void
    {
        $this->withoutVite();

        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin/dashboard')->assertForbidden();
    }

    public function test_admin_user_can_access_admin_dashboard(): void
    {
        $this->withoutVite();

        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user)->get('/admin/dashboard')->assertOk();
    }
}
