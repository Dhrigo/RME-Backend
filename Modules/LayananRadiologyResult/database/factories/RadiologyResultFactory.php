<?php

namespace Modules\LayananRadiologyResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananRadiologyResult\Models\RadiologyResult;

class RadiologyResultFactory extends Factory
{
    protected $model = RadiologyResult::class;

    public function definition(): array
    {
        return [
            'radiology_order_id' => \Modules\LayananRadiologyOrder\Models\RadiologyOrder::factory(),
            'findings' => fake()->paragraph(),
            'impression' => fake()->paragraph(),
            'radiologist_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'status' => fake()->randomElement(['pending', 'final']),
        ];
    }
}
