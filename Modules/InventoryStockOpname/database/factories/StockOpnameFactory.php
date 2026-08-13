<?php

namespace Modules\InventoryStockOpname\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryStockOpname\Models\StockOpname;

class StockOpnameFactory extends Factory
{
    protected $model = StockOpname::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'opname_date' => fake()->date(),
            'conducted_by' => Employee::factory(),
            'status' => 'in_progress',
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
