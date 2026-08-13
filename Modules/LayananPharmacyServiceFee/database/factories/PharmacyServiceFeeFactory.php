<?php

namespace Modules\LayananPharmacyServiceFee\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPharmacyServiceFee\Models\PharmacyServiceFee;

class PharmacyServiceFeeFactory extends Factory
{
    protected $model = PharmacyServiceFee::class;

    public function definition(): array
    {
        return [
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'fee_name' => fake()->words(3, true),
            'amount' => fake()->randomFloat(2, 1, 100),
            'is_active' => true,
        ];
    }
}
