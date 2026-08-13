<?php

namespace Modules\InventoryWardStockTransaction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardStockTransaction\Models\WardStockTransaction;

class WardStockTransactionFactory extends Factory
{
    protected $model = WardStockTransaction::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'item_id' => Item::factory(),
            'type' => 'in',
            'quantity' => fake()->numberBetween(1, 30),
            'performed_by' => User::factory(),
            'performed_at' => now(),
            'notes' => null,
        ];
    }
}
