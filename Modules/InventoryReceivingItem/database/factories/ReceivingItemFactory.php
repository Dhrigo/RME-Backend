<?php

namespace Modules\InventoryReceivingItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryReceivingItem\Models\ReceivingItem;
use Modules\InventoryReceivingRecord\Models\ReceivingRecord;

class ReceivingItemFactory extends Factory
{
    protected $model = ReceivingItem::class;

    public function definition(): array
    {
        return [
            'receiving_record_id' => ReceivingRecord::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(1, 50),
            'unit_price' => fake()->randomFloat(2, 1000, 500000),
        ];
    }
}
