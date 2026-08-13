<?php

namespace Modules\InventoryGoodsReturnItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;
use Modules\InventoryGoodsReturnItem\Models\GoodsReturnItem;
use Modules\InventoryItem\Models\Item;

class GoodsReturnItemFactory extends Factory
{
    protected $model = GoodsReturnItem::class;

    public function definition(): array
    {
        return [
            'goods_return_id' => GoodsReturn::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(1, 20),
            'unit_price' => fake()->randomFloat(2, 1000, 100000),
            'reason' => fake()->randomElement(['Rusak', 'Kadaluarsa', 'Salah kirim']),
        ];
    }
}
