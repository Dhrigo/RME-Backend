<?php

namespace Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Models\ProcedureConsentPatientAcknowledgement;

class ProcedureConsentPatientAcknowledgementFactory extends Factory
{
    protected $model = ProcedureConsentPatientAcknowledgement::class;

    public function definition(): array
    {
        return [
            'consent_id' => \Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent::factory(),
            'acknowledger_name' => fake()->name(),
            'relationship_to_patient' => 'self',
            'decision' => fake()->randomElement(['agree','refuse']),
            'signed_at' => now(),
        ];
    }
}
