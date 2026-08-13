<?php

namespace Modules\MedicalRecordPhysicalExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPhysicalExamination\Models\PhysicalExamination;

class PhysicalExaminationFactory extends Factory
{
    protected $model = PhysicalExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'general_condition' => 'Good',
            'consciousness_gcs' => 'E4V5M6 (Compos Mentis)',
            'head_to_toe_notes' => 'Head-to-toe examination within normal limits',
            'examined_by' => 1,
            'examined_at' => now(),
        ];
    }
}
