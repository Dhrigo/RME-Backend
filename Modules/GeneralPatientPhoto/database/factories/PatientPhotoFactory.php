<?php

namespace Modules\GeneralPatientPhoto\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralPatientPhoto\Models\PatientPhoto::class;

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

