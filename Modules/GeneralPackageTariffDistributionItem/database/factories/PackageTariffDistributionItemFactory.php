<?php

namespace Modules\GeneralPackageTariffDistributionItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;
use Modules\GeneralPackageTariffDistributionItem\Models\PackageTariffDistributionItem;

class PackageTariffDistributionItemFactory extends Factory
{
    protected $model = PackageTariffDistributionItem::class;

    public function definition(): array
    {
        return [
            'package_tariff_distribution_id' => PackageTariffDistribution::factory(),
            'recipient_type' => fake()->randomElement(PackageTariffDistributionItem::RECIPIENT_TYPES),
            'recipient_id' => null,
            'percentage' => fake()->randomFloat(2, 5, 100),
            'amount' => fake()->randomFloat(2, 10000, 500000),
            'notes' => null,
        ];
    }
}
