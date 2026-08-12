<?php

namespace Modules\InventoryGoodsReceipt\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryItem\Models\Item;
use Modules\InventorySupplier\Models\Supplier;

class GoodsReceiptFactory extends Factory
{
    protected $model = GoodsReceipt::class;

    public function definition(): array
    {
        return [
            'receipt_number' => fake()->unique()->numerify('REC-##########'),
            'supplier_id' => Supplier::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(1, 100),
            'unit_price' => fake()->randomFloat(2, 1000, 100000),
            'received_by' => User::factory(),
            'received_at' => now(),
            'notes' => null,
        ];
    }
}
