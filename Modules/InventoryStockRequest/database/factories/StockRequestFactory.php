<?php

namespace Modules\InventoryStockRequest\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Models\StockRequest;

class StockRequestFactory extends Factory
{
    protected $model = StockRequest::class;

    public function definition(): array
    {
        return [
            'request_number' => fake()->unique()->numerify('REQ-##########'),
            'ward_id' => Ward::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(1, 20),
            'requested_by' => User::factory(),
            'requested_at' => now(),
            'fulfilled_at' => null,
            'notes' => null,
            'status' => 'pending',
        ];
    }
}
