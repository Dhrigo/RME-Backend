<?php

namespace Modules\MedicalRecordNutritionDietPattern\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordNutritionDietPattern\Models\NutritionDietPattern;

class NutritionDietPatternFactory extends Factory
{
    protected $model = NutritionDietPattern::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'diet_type' => fake()->randomElement(['regular','soft','liquid','diabetic','low_salt']),
            'appetite' => fake()->randomElement(['good','fair','poor']),
            'meal_frequency_per_day' => fake()->numberBetween(2,5),
            'food_allergies' => null,
            'special_diet_notes' => null,
            'assessed_at' => now(),
        ];
    }
}
