<?php

namespace Modules\LayananMedicalSupplyUsage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage;

class MedicalSupplyUsageFactory extends Factory
{
    protected $model = MedicalSupplyUsage::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'recorded_by' => \Modules\Auth\Models\User::factory(),
            'used_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'status' => fake()->randomElement(['draft', 'posted']),
        ];
    }
}
