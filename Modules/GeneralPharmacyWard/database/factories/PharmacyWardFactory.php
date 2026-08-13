<?php

namespace Modules\GeneralPharmacyWard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyWardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralPharmacyWard\Models\PharmacyWard::class;

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

