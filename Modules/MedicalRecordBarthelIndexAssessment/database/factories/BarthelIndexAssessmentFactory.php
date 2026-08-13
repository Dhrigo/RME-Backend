<?php

namespace Modules\MedicalRecordBarthelIndexAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBarthelIndexAssessment\Models\BarthelIndexAssessment;

class BarthelIndexAssessmentFactory extends Factory
{
    protected $model = BarthelIndexAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'feeding' => 10,
            'bathing' => 5,
            'grooming' => 5,
            'dressing' => 10,
            'bowel_control' => 10,
            'bladder_control' => 10,
            'toilet_use' => 10,
            'transfers' => 15,
            'mobility' => 15,
            'stairs' => 10,
            'total_score' => 100,
            'interpretation' => 'Independent',
            'assessed_at' => now(),
        ];
    }
}
