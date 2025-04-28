<?php

namespace Database\Factories;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'user_id' => User::factory(),
            'date_at' => $this->faker->date(),
            'hour_in' => $this->faker->time(),
            'type' => $this->faker->randomElement([AppointmentTypeEnum::getValuesToArray()]),
            'reason' => $this->faker->text(),
            'status' => $this->faker->randomElement([AppointmentStatusEnum::getValuesToArray()]),
        ];
    }
}
