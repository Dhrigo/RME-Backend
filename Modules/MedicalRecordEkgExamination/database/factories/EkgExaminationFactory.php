<?php

namespace Modules\MedicalRecordEkgExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordEkgExamination\Models\EkgExamination;

class EkgExaminationFactory extends Factory
{
    protected $model = EkgExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'heart_rate_bpm' => 75,
            'rhythm' => 'Sinus Rhythm',
            'p_wave' => 'Normal',
            'pr_interval_ms' => 160,
            'qrs_duration_ms' => 90,
            'st_segment' => 'Isoelectric',
            't_wave' => 'Upright',
            'conclusion' => 'Normal EKG',
            'examined_at' => now(),
        ];
    }
}
