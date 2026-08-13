<?php

namespace Modules\InventoryStockRequestItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Models\StockRequest;
use Modules\InventoryStockRequestItem\Models\StockRequestItem;

class StockRequestItemFactory extends Factory
{
    protected $model = StockRequestItem::class;

    public function definition(): array
    {
        return [
            'stock_request_id' => StockRequest::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(1, 50),
        ];
    }
}
