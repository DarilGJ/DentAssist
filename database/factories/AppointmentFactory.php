<?php

namespace Database\Factories;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'user_id' => User::factory(),
            'date_at' => $this->faker->dateTimeBetween('now +1 day', '+1 month'),
            'hour_in' => $this->faker->time(),
            'type' => $this->faker->randomElement(AppointmentTypeEnum::getValuesToArray()),
            'reason' => $this->faker->text(),
            'status' => $this->faker->randomElement(AppointmentStatusEnum::getValuesToArray()),
        ];
    }
}
