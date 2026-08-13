<?php

namespace Modules\MedicalRecordDoctorProcedureConsent\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;

class DoctorProcedureConsentFactory extends Factory
{
    protected $model = DoctorProcedureConsent::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'doctor_id' => \Modules\GeneralDoctor\Models\Doctor::factory(),
            'created_by' => null,
            'procedure_name' => fake()->words(3,true),
            'indication' => fake()->sentence(6),
            'consent_decision' => 'pending',
            'signed_at' => null,
        ];
    }
}
