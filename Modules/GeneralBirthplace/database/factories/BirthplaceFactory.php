<?php

namespace Modules\GeneralBirthplace\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralBirthplace\Models\Birthplace;

class BirthplaceFactory extends Factory
{
    protected $model = Birthplace::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'village_id' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
