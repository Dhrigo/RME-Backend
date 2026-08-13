<?php

namespace Modules\MedicalRecordGeneralExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordGeneralExamination\Models\GeneralExamination;

class GeneralExaminationFactory extends Factory
{
    protected $model = GeneralExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'general_appearance' => 'Well-appearing, no acute distress',
            'consciousness_level' => 'Alert',
            'nutritional_status' => 'Well-nourished',
            'posture' => 'Upright, normal',
            'gait' => 'Normal, steady',
            'examined_at' => now(),
        ];
    }
}
