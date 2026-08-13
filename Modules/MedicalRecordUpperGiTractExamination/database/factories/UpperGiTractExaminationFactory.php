<?php

namespace Modules\MedicalRecordUpperGiTractExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordUpperGiTractExamination\Models\UpperGiTractExamination;

class UpperGiTractExaminationFactory extends Factory
{
    protected $model = UpperGiTractExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'procedure_type' => 'endoscopy',
            'esophagus_findings' => 'No varices, no strictures',
            'stomach_findings' => 'No ulcers or masses',
            'duodenum_findings' => 'Normal mucosa',
            'hpylori_result' => 'negative',
            'examined_at' => now(),
        ];
    }
}
