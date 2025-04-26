<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Enums\GenderEnum;
use Illuminate\Support\Carbon;
use App\Enums\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'address' => $this->faker->address()
        ];
    }
}
