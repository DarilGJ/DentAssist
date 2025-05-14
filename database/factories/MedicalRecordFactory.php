<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'patient_id' => Patient::factory(),
            'user_id' => User::factory(),
            'diagnosis' => $this->faker->text(),
            'treatment' => $this->faker->text(),
            'xray' => $this->faker->imageUrl(),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
