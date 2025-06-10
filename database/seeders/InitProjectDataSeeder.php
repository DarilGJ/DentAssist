<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitProjectDataSeeder extends Seeder
{
    public function run(): void
    {
        if (! User::where('email', $email = 'admin@dev.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => $email,
                'role' => RoleEnum::admin,
            ]);
        }
    }
}
