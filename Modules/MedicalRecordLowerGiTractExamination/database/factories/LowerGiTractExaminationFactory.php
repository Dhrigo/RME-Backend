<?php

namespace Modules\MedicalRecordLowerGiTractExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordLowerGiTractExamination\Models\LowerGiTractExamination;

class LowerGiTractExaminationFactory extends Factory
{
    protected $model = LowerGiTractExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'procedure_type' => 'colonoscopy',
            'colon_findings' => 'No masses or strictures',
            'rectum_findings' => 'Normal mucosa',
            'polyps_found' => false,
            'biopsy_taken' => false,
            'examined_at' => now(),
        ];
    }
}
