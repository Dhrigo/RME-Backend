<?php

namespace Modules\GeneralPatientIdentityCard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientIdentityCard\Models\PatientIdentityCard;

class PatientIdentityCardFactory extends Factory
{
    protected $model = PatientIdentityCard::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'id_type' => fake()->randomElement(['KTP', 'SIM', 'Paspor']),
            'id_number' => fake()->unique()->numerify('################'),
            'issued_at' => fake()->date(),
        ];
    }
}
