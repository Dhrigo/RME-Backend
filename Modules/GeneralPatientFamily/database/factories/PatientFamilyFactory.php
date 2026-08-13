<?php

namespace Modules\GeneralPatientFamily\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFamilyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralPatientFamily\Models\PatientFamily::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_id' => fake()->randomNumber(5),
            'name' => fake()->name(),
            'relationship' => fake()->randomElement(['Ayah', 'Ibu', 'Anak', 'Saudara Kandung']),
            'is_active' => fake()->boolean(90),
        ];
    }
}
