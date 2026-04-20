<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@redeemerchurch.org');
        $password = env('ADMIN_PASSWORD', 'Admin@12345');

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => $password,
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        if ($this->command) {
            $this->command->info('Admin user seeded successfully.');
            $this->command->line("Email: {$email}");
            $this->command->line("Password: {$password}");
        }
    }
}
