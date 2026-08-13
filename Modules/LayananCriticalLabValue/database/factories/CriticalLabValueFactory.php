<?php

namespace Modules\LayananCriticalLabValue\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananCriticalLabValue\Models\CriticalLabValue;

class CriticalLabValueFactory extends Factory
{
    protected $model = CriticalLabValue::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'parameter_name' => fake()->words(3, true),
            'critical_value' => fake()->words(3, true),
            'notified_to' => fake()->words(3, true),
            'notified_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'acknowledged' => false,
        ];
    }
}
