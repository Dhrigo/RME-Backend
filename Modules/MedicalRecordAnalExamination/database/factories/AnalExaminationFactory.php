<?php

namespace Modules\MedicalRecordAnalExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordAnalExamination\Models\AnalExamination;

class AnalExaminationFactory extends Factory
{
    protected $model = AnalExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'inspection' => 'Normal external appearance',
            'palpation' => 'No tenderness or mass',
            'sphincter_tone' => 'Normal',
            'rectal_toucher_findings' => 'Mucosa smooth, glove clean',
            'ampulla_recti' => 'Collapse normal',
            'findings' => 'Normal anal examination',
            'examined_at' => now(),
        ];
    }
}
