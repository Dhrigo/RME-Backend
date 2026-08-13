<?php

namespace Modules\GeneralPatientFamilyContact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFamilyContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralPatientFamilyContact\Models\PatientFamilyContact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_family_id' => fake()->randomNumber(5),
            'contact_type' => fake()->randomElement(['Phone', 'Email', 'WhatsApp']),
            'contact_value' => fake()->phoneNumber(),
            'is_active' => fake()->boolean(90),
        ];
    }
}

