<?php

namespace Modules\InventoryItemPrice\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryItemPrice\Models\ItemPrice;

class ItemPriceFactory extends Factory
{
    protected $model = ItemPrice::class;

    public function definition(): array
    {
        return [
            'item_id' => Item::factory(),
            'price' => fake()->randomFloat(2, 1000, 500000),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
