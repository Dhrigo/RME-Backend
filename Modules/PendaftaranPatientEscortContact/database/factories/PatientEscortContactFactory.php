<?php

namespace Modules\PendaftaranPatientEscortContact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranPatientEscortContact\Models\PatientEscortContact;

class PatientEscortContactFactory extends Factory
{
    protected $model = PatientEscortContact::class;

    public function definition(): array
    {
        return [
            'patient_escort_id' => PatientEscort::factory(),
            'contact_type' => fake()->randomElement(PatientEscortContact::CONTACT_TYPES),
            'contact_value' => fake()->numerify('08##########'),
            'is_primary' => false,
        ];
    }
}
