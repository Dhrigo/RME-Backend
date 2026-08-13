<?php

namespace Modules\GeneralPackageTariffDistribution\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPackage\Models\Package;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;

class PackageTariffDistributionFactory extends Factory
{
    protected $model = PackageTariffDistribution::class;

    public function definition(): array
    {
        return [
            'package_id' => Package::factory(),
            'component_name' => fake()->randomElement(PackageTariffDistribution::COMPONENTS),
            'percentage' => fake()->randomFloat(2, 5, 50),
            'amount' => fake()->randomFloat(2, 10000, 1000000),
            'is_active' => true,
        ];
    }
}
