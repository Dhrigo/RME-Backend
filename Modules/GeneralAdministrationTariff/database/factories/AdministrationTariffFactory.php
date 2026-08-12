<?php

namespace Modules\GeneralAdministrationTariff\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralAdministrationTariff\Models\AdministrationTariff;

class AdministrationTariffFactory extends Factory
{
    protected $model = AdministrationTariff::class;

    public function definition(): array
    {
        return [
            'price' => fake()->randomFloat(2, 10, 1000),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
