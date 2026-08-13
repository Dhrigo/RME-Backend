<?php

namespace Modules\InventoryReceivingRecord\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryReceivingRecord\Models\ReceivingRecord;

class ReceivingRecordFactory extends Factory
{
    protected $model = ReceivingRecord::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'received_by' => Employee::factory(),
            'received_at' => now(),
            'notes' => null,
        ];
    }
}
