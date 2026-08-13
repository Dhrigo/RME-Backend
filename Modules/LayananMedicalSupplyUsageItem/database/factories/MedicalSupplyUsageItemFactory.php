<?php

namespace Modules\LayananMedicalSupplyUsageItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananMedicalSupplyUsageItem\Models\MedicalSupplyUsageItem;

class MedicalSupplyUsageItemFactory extends Factory
{
    protected $model = MedicalSupplyUsageItem::class;

    public function definition(): array
    {
        return [
            'medical_supply_usage_id' => \Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage::factory(),
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'quantity' => fake()->numberBetween(1, 20),
            'unit' => fake()->words(3, true),
        ];
    }
}
