<?php

namespace Modules\MedicalRecordProcedureConsentInformation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation;

class ProcedureConsentInformationFactory extends Factory
{
    protected $model = ProcedureConsentInformation::class;

    public function definition(): array
    {
        return [
            'consent_id' => \Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent::factory(),
            'explained_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'diagnosis_explanation' => fake()->sentence(6),
            'procedure_explanation' => fake()->sentence(6),
            'purpose' => fake()->sentence(6),
            'risks_and_complications' => fake()->sentence(6),
            'alternative_procedures' => fake()->sentence(6),
            'prognosis' => fake()->sentence(6),
            'explained_at' => now(),
        ];
    }
}
