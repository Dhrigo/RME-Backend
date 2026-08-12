<?php

namespace Modules\GeneralWardType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWardType\Models\WardType;

class WardTypeFactory extends Factory
{
    protected $model = WardType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
