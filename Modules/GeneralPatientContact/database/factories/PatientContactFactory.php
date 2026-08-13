<?php

namespace Modules\GeneralPatientContact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientContact\Models\PatientContact;

class PatientContactFactory extends Factory
{
    protected $model = PatientContact::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'contact_type' => fake()->randomElement(PatientContact::CONTACT_TYPES),
            'contact_value' => fake()->phoneNumber(),
            'is_primary' => false,
            'is_active' => true,
        ];
    }
}
