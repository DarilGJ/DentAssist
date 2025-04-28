<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->word(),
            'birth_at' => Carbon::now()->subYears(3),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(GenderEnum::getValuesToArray()),
            'marital_status' => $this->faker->randomElement(MaritalStatusEnum::getValuesToArray()),
            'email' => $this->faker->unique()->safeEmail(),
            'allergies' => $this->faker->word(),
            'address' => $this->faker->address(),
        ];
    }
}
