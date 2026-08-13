<?php

namespace Modules\InventoryMinimumStockLevel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryMinimumStockLevel\Models\MinimumStockLevel;

class MinimumStockLevelFactory extends Factory
{
    protected $model = MinimumStockLevel::class;

    public function definition(): array
    {
        return [
            'item_id' => Item::factory(),
            'ward_id' => null,
            'minimum_quantity' => fake()->numberBetween(5, 100),
        ];
    }
}
