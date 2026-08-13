<?php

namespace Modules\InventoryShipment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryShipment\Models\Shipment;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'from_ward_id' => Ward::factory(),
            'to_ward_id' => Ward::factory(),
            'shipped_by' => Employee::factory(),
            'shipped_at' => now(),
            'status' => 'pending',
        ];
    }
}
