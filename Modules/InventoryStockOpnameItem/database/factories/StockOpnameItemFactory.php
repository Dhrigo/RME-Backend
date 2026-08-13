<?php

namespace Modules\InventoryStockOpnameItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockOpname\Models\StockOpname;
use Modules\InventoryStockOpnameItem\Models\StockOpnameItem;

class StockOpnameItemFactory extends Factory
{
    protected $model = StockOpnameItem::class;

    public function definition(): array
    {
        $system = fake()->numberBetween(10, 200);
        $physical = fake()->numberBetween(0, 200);

        return [
            'stock_opname_id' => StockOpname::factory(),
            'item_id' => Item::factory(),
            'system_quantity' => $system,
            'physical_quantity' => $physical,
            'difference' => $physical - $system,
        ];
    }
}
