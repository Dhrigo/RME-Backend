<?php

namespace Modules\PasienPatientPortalAccount\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PasienPatientPortalAccount\Models\PatientPortalAccount;

class PatientPortalAccountFactory extends Factory
{
    protected $model = PatientPortalAccount::class;

    public function definition(): array
    {
        return [
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'username' => fake()->words(3, true),
            'email' => fake()->words(3, true),
            'phone' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
