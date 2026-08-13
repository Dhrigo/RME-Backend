<?php

namespace Modules\PendaftaranPatientGuardianContact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranPatientGuardianContact\Models\PatientGuardianContact;

class PatientGuardianContactFactory extends Factory
{
    protected $model = PatientGuardianContact::class;

    public function definition(): array
    {
        return [
            'patient_guardian_id' => PatientGuardian::factory(),
            'contact_type' => fake()->randomElement(PatientGuardianContact::CONTACT_TYPES),
            'contact_value' => fake()->numerify('08##########'),
            'is_primary' => false,
        ];
    }
}
