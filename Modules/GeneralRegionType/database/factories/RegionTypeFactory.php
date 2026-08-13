<?php

namespace Modules\GeneralRegionType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralRegionType\Models\RegionType;

class RegionTypeFactory extends Factory
{
    protected $model = RegionType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'digit_count' => 2,
            'delimiter' => '',
            'is_active' => true,
        ];
    }
}
