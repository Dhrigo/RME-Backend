<?php

namespace Modules\GeneralLaboratoryWard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoryWardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralLaboratoryWard\Models\LaboratoryWard::class;

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

