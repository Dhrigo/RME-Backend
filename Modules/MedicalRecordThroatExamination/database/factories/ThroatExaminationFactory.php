<?php

namespace Modules\MedicalRecordThroatExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordThroatExamination\Models\ThroatExamination;

class ThroatExaminationFactory extends Factory
{
    protected $model = ThroatExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'pharynx' => 'Not injected',
            'uvula' => 'Midline',
            'mucosa' => 'Moist, pink',
            'exudate' => false,
            'findings' => 'Normal throat examination',
            'examined_at' => now(),
        ];
    }
}
