<?php

namespace Modules\MedicalRecordDiagnosis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PendaftaranVisit\Models\Visit;

class DiagnosisFactory extends Factory
{
    protected $model = Diagnosis::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'diagnosis_code_id' => DiagnosisCode::factory(),
            'is_primary' => false,
            'recorded_at' => now(),
            'recorded_by' => null,
            'status' => 'active',
        ];
    }

    public function primary(): static
    {
        return $this->state(fn () => ['is_primary' => true]);
    }
}
