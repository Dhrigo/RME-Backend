<?php

namespace Modules\GeneralWardVisitType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWardVisitType\Models\WardVisitType;

class WardVisitTypeFactory extends Factory
{
    protected $model = WardVisitType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
