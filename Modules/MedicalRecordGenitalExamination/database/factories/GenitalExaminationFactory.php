<?php

namespace Modules\MedicalRecordGenitalExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordGenitalExamination\Models\GenitalExamination;

class GenitalExaminationFactory extends Factory
{
    protected $model = GenitalExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'external_genitalia' => 'Normal external genitalia',
            'discharge_characteristics' => 'None',
            'lesions_or_masses' => 'None',
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
