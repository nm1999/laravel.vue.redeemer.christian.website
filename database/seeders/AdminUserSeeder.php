<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminPassword = env('ADMIN_PASSWORD');

        if (! $adminPassword) {
            $adminPassword = Str::random(24);
            $this->command?->warn('ADMIN_PASSWORD is not set. Generated temporary admin password: '.$adminPassword);
        }

        User::query()->updateOrCreate(
            ['email' => 'admin@redeemerchurch.org'],
            [
                'name' => 'Admin User',
                'password' => Hash::make($adminPassword),
                'is_admin' => true,
            ]
        );
    }
}
