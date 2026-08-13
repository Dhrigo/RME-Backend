<?php

namespace Modules\LayananLabCultureResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabCultureResult\Models\LabCultureResult;

class LabCultureResultFactory extends Factory
{
    protected $model = LabCultureResult::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'specimen_type' => fake()->words(3, true),
            'organism_found' => fake()->words(3, true),
            'colony_count' => fake()->words(3, true),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'result_status' => fake()->randomElement(['pending', 'positive', 'negative']),
        ];
    }
}
