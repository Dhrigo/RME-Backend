<?php

namespace Modules\GeneralServiceTariffDistribution\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralServiceTariffDistribution\Models\ServiceTariffDistribution;

class ServiceTariffDistributionFactory extends Factory
{
    protected $model = ServiceTariffDistribution::class;

    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 10, 1000),
            'is_active' => true,
        ];
    }
}
