<?php

namespace Modules\InventoryShipmentItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryShipment\Models\Shipment;
use Modules\InventoryShipmentItem\Models\ShipmentItem;

class ShipmentItemFactory extends Factory
{
    protected $model = ShipmentItem::class;

    public function definition(): array
    {
        return [
            'shipment_id' => Shipment::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(1, 50),
        ];
    }
}
