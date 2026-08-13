<?php

namespace Modules\GeneralReference\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReference\Models\Reference;

class ReferenceFactory extends Factory
{
    protected $model = Reference::class;

    public function definition(): array
    {
        return [
            'category' => fake()->words(3, true),
            'code' => fake()->words(3, true),
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
