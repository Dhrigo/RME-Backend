<?php

namespace Modules\MedicalRecordEyeExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordEyeExamination\Models\EyeExamination;

class EyeExaminationFactory extends Factory
{
    protected $model = EyeExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'side' => 'bilateral',
            'visual_acuity' => '20/20',
            'pupil_size_mm' => 3.0,
            'pupil_reflex' => 'Brisk, equal, reactive to light',
            'conjunctiva' => 'Not injected',
            'sclera' => 'White, not icteric',
            'findings' => 'Normal eye examination',
            'examined_at' => now(),
        ];
    }
}
