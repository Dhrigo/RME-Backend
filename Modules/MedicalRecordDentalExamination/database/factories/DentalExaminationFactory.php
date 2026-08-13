<?php

namespace Modules\MedicalRecordDentalExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordDentalExamination\Models\DentalExamination;

class DentalExaminationFactory extends Factory
{
    protected $model = DentalExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'decayed_teeth_count' => 2,
            'missing_teeth_count' => 1,
            'filled_teeth_count' => 3,
            'odontogram_json' => ['18' => 'sou', '17' => 'car'],
            'occlusion_status' => 'Normal Occlusion',
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
