<?php

namespace Modules\PenjaminRSDischargeMethod\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PenjaminRSDischargeMethod\Models\DischargeMethod;

class DischargeMethodFactory extends Factory
{
    protected $model = DischargeMethod::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}