<?php

namespace Modules\GeneralOxygenTariff\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralOxygenTariff\Models\OxygenTariff;

class OxygenTariffFactory extends Factory
{
    protected $model = OxygenTariff::class;

    public function definition(): array
    {
        return [
            'price' => fake()->randomFloat(2, 10, 1000),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
