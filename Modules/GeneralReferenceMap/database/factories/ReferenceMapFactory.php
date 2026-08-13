<?php

namespace Modules\GeneralReferenceMap\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReferenceMap\Models\ReferenceMap;

class ReferenceMapFactory extends Factory
{
    protected $model = ReferenceMap::class;

    public function definition(): array
    {
        return [
            'source_system' => fake()->words(3, true),
            'source_code' => fake()->words(3, true),
            'target_category' => fake()->words(3, true),
            'target_code' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
