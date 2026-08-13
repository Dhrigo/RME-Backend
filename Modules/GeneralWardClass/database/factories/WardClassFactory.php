<?php

namespace Modules\GeneralWardClass\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WardClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralWardClass\Models\WardClass::class;

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

