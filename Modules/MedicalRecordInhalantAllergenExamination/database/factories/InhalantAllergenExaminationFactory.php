<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordInhalantAllergenExamination\Models\InhalantAllergenExamination;

class InhalantAllergenExaminationFactory extends Factory
{
    protected $model = InhalantAllergenExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'allergen_name' => $this->faker->randomElement(['Dust Mites', 'Pollen', 'Cat Dander', 'Mold']),
            'reaction_grade' => '2+',
            'wheal_diameter_mm' => 5.5,
            'erythema_diameter_mm' => 12.0,
            'interpretation' => 'Positive reaction',
            'examined_at' => now(),
        ];
    }
}
