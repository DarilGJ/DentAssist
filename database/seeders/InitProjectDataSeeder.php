<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InitProjectDataSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
        ]);

        // Patient and Clinic accounts
        User::factory()->count(10)->create([
            'role' => 'patient',
        ]);

        User::factory()->count(2)->create([
            'role' => 'clinic',
        ]);
    }
}
