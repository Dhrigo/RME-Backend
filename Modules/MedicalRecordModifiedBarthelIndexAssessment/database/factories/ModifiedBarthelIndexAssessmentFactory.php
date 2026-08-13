<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Models\ModifiedBarthelIndexAssessment;

class ModifiedBarthelIndexAssessmentFactory extends Factory
{
    protected $model = ModifiedBarthelIndexAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'feeding' => 10,
            'bathing' => 5,
            'personal_hygiene' => 5,
            'dressing' => 10,
            'bowel_control' => 10,
            'bladder_control' => 10,
            'toilet_use' => 10,
            'chair_bed_transfer' => 15,
            'ambulation' => 15,
            'stairs' => 10,
            'total_score' => 100,
            'interpretation' => 'Independent',
            'assessed_at' => now(),
        ];
    }
}
