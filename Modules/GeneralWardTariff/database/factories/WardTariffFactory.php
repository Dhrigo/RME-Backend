<?php

namespace Modules\GeneralWardTariff\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWardTariff\Models\WardTariff;

class WardTariffFactory extends Factory
{
    protected $model = WardTariff::class;

    public function definition(): array
    {
        return [
            'price' => fake()->randomFloat(2, 10, 1000),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
