<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFamilyIdentityCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralPatientFamilyIdentityCard\Models\PatientFamilyIdentityCard::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_family_id' => fake()->randomNumber(5),
            'identity_type' => fake()->randomElement(['KTP', 'SIM', 'Passport']),
            'identity_number' => fake()->unique()->numerify('1################'),
            'is_active' => fake()->boolean(90),
        ];
    }
}

