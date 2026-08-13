<?php

namespace Modules\MedicalRecordAbdomenExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordAbdomenExamination\Models\AbdomenExamination;

class AbdomenExaminationFactory extends Factory
{
    protected $model = AbdomenExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'inspection' => 'Flat, symmetrical',
            'auscultation_bowel_sounds' => 'Normoactive',
            'palpation' => 'Soft, non-tender',
            'percussion' => 'Tympanic',
            'tenderness' => false,
            'distension' => false,
            'liver_span_cm' => 10.0,
            'findings' => 'Normal abdominal examination',
            'examined_at' => now(),
        ];
    }
}
