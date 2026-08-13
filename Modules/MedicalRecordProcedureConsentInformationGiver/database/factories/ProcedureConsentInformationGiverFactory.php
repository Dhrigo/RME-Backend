<?php

namespace Modules\MedicalRecordProcedureConsentInformationGiver\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordProcedureConsentInformationGiver\Models\ProcedureConsentInformationGiver;

class ProcedureConsentInformationGiverFactory extends Factory
{
    protected $model = ProcedureConsentInformationGiver::class;

    public function definition(): array
    {
        return [
            'consent_id' => \Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent::factory(),
            'giver_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'giver_role' => 'doctor',
            'signed_at' => now(),
        ];
    }
}
