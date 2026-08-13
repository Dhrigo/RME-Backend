<?php

namespace Modules\MedicalRecordTongueExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTongueExamination\Models\TongueExamination;

class TongueExaminationFactory extends Factory
{
    protected $model = TongueExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'color' => 'Pink',
            'coating' => 'None',
            'moisture' => 'Moist',
            'lesions' => null,
            'movement' => 'Normal, midline protrusion',
            'findings' => 'Normal tongue examination',
            'examined_at' => now(),
        ];
    }
}
