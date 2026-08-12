<?php

namespace Modules\GeneralOccupation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralOccupation\Models\Occupation;

class OccupationFactory extends Factory
{
    protected $model = Occupation::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
