<?php

namespace Modules\MedicalRecordDifferentialDiagnosis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDifferentialDiagnosis\Models\DifferentialDiagnosis;

class DifferentialDiagnosisFactory extends Factory
{
    protected $model = DifferentialDiagnosis::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'diagnosis_code_id' => DiagnosisCode::factory(),
            'description' => fake()->words(3, true),
            'rank' => fake()->numberBetween(1, 10),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
            'status' => 'considered',
        ];
    }
}
