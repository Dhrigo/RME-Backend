<?php

namespace Modules\MedicalRecordPalateExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPalateExamination\Models\PalateExamination;

class PalateExaminationFactory extends Factory
{
    protected $model = PalateExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'hard_palate' => 'Intact',
            'soft_palate' => 'Intact, symmetrical elevation',
            'uvula_position' => 'Midline',
            'cleft_palate' => false,
            'findings' => 'Normal palate examination',
            'examined_at' => now(),
        ];
    }
}
