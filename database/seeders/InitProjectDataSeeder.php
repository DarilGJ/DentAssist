<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitProjectDataSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
        ]);

        // Patient and Clinic accounts
        User::factory()->create([
            'role' => RoleEnum::patient,
            'email' => 'patient@dev.com',
        ]);

        User::factory()->create([
            'role' => RoleEnum::clinic,
            'email' => 'clinic@dev.com',
        ]);

        // Appointments
        Appointment::factory()
            ->count(50)
            ->for($admin)
            ->has(Patient::factory()->count(3))
            ->create();
    }
}
