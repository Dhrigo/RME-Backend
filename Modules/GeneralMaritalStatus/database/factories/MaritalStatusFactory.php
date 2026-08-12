<?php

namespace Modules\GeneralMaritalStatus\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralMaritalStatus\Models\MaritalStatus;

class MaritalStatusFactory extends Factory
{
    protected $model = MaritalStatus::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
