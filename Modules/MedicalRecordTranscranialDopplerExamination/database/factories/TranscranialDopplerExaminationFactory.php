<?php

namespace Modules\MedicalRecordTranscranialDopplerExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTranscranialDopplerExamination\Models\TranscranialDopplerExamination;

class TranscranialDopplerExaminationFactory extends Factory
{
    protected $model = TranscranialDopplerExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'indication' => 'Suspected vasospasm',
            'vessel' => 'MCA',
            'mean_velocity_cm_s' => 55.0,
            'pulsatility_index' => 0.85,
            'findings' => 'Normal flow velocities',
            'examined_at' => now(),
        ];
    }
}
