<?php

namespace Modules\MedicalRecordFoodAllergenExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFoodAllergenExamination\Models\FoodAllergenExamination;

class FoodAllergenExaminationFactory extends Factory
{
    protected $model = FoodAllergenExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'food_item' => $this->faker->randomElement(['Egg White', 'Cow Milk', 'Peanut', 'Shrimp', 'Soybean']),
            'reaction_grade' => '1+',
            'wheal_diameter_mm' => 3.5,
            'symptoms_observed' => 'Urticaria',
            'interpretation' => 'Mild allergy',
            'examined_at' => now(),
        ];
    }
}
