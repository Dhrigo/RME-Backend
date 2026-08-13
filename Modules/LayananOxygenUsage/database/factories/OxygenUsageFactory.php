<?php

namespace Modules\LayananOxygenUsage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananOxygenUsage\Models\OxygenUsage;

class OxygenUsageFactory extends Factory
{
    protected $model = OxygenUsage::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'flow_rate_lpm' => fake()->randomFloat(1, 1, 100),
            'method' => fake()->words(3, true),
            'started_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'ended_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'recorded_by' => \Modules\Auth\Models\User::factory(),
        ];
    }
}
