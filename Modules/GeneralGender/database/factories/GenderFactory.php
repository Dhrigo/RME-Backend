<?php

namespace Modules\GeneralGender\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralGender\Models\Gender;

class GenderFactory extends Factory
{
    protected $model = Gender::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
