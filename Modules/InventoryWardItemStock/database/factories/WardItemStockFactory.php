<?php

namespace Modules\InventoryWardItemStock\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardItemStock\Models\WardItemStock;

class WardItemStockFactory extends Factory
{
    protected $model = WardItemStock::class;

    public function definition(): array
    {
        return [
            'item_id' => Item::factory(),
            'ward_id' => Ward::factory(),
            'quantity' => fake()->numberBetween(0, 200),
        ];
    }
}
