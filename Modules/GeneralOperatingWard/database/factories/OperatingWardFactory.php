<?php

namespace Modules\GeneralOperatingWard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OperatingWardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralOperatingWard\Models\OperatingWard::class;

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

