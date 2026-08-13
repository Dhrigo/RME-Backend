<?php

namespace Modules\GeneralAdmissionDiagnosis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralAdmissionDiagnosis\Models\AdmissionDiagnosis;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\PendaftaranVisit\Models\Visit;

class AdmissionDiagnosisFactory extends Factory
{
    protected $model = AdmissionDiagnosis::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'diagnosis_code_id' => DiagnosisCode::factory(),
            'diagnosis_text' => fake()->randomElement(['Demam Berdarah Dengue', 'Gastroenteritis Akut', 'Hipertensi Stage 2', 'Pneumonia', 'Observasi Febris']),
            'is_primary' => true,
            'diagnosed_at' => now(),
        ];
    }
}
