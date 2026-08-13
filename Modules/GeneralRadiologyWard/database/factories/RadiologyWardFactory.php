<?php

namespace Modules\GeneralRadiologyWard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RadiologyWardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralRadiologyWard\Models\RadiologyWard::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'is_active' => fake()->boolean(90),
        ];
    }
}

