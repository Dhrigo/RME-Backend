<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPharmacyDiagnosis\Models\PharmacyDiagnosis;

class PharmacyDiagnosisFactory extends Factory
{
    protected $model = PharmacyDiagnosis::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'prescription_id' => Prescription::factory(),
            'problem_category' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'recommendation' => fake()->sentence(),
            'assessed_by' => Employee::factory(),
            'assessed_at' => now(),
            'status' => 'active',
        ];
    }
}
