<?php

namespace Modules\InventoryItemSerialNumber\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItemSerialNumber\Models\ItemSerialNumber;
use Modules\InventoryWardItemStock\Models\WardItemStock;

class ItemSerialNumberFactory extends Factory
{
    protected $model = ItemSerialNumber::class;

    public function definition(): array
    {
        return [
            'ward_item_stock_id' => WardItemStock::factory(),
            'serial_number' => fake()->unique()->bothify('SN-########'),
            'expiry_date' => fake()->dateTimeBetween('+1 month', '+2 years')->format('Y-m-d'),
        ];
    }
}
