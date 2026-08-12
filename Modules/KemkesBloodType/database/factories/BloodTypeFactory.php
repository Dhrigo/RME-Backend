<?php

namespace Modules\KemkesBloodType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\KemkesBloodType\Models\BloodType;

class BloodTypeFactory extends Factory
{
    protected $model = BloodType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
