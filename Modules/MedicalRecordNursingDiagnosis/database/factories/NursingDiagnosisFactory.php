<?php

namespace Modules\MedicalRecordNursingDiagnosis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingDiagnosis\Models\NursingDiagnosis;

class NursingDiagnosisFactory extends Factory
{
    protected $model = NursingDiagnosis::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'diagnosis_label' => fake()->words(3, true),
            'related_factors' => fake()->sentence(),
            'defining_characteristics' => fake()->sentence(),
            'priority' => fake()->words(3, true),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
            'status' => 'active',
        ];
    }
}
