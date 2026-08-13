<?php

namespace Modules\LayananAntimicrobialStewardshipGeneralExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Models\AntimicrobialStewardshipGeneralExamination;

class AntimicrobialStewardshipGeneralExaminationFactory extends Factory
{
    protected $model = AntimicrobialStewardshipGeneralExamination::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'temperature' => fake()->randomFloat(1, 1, 100),
            'pulse' => fake()->numberBetween(1, 20),
            'respiration_rate' => fake()->numberBetween(1, 20),
            'blood_pressure' => fake()->words(3, true),
            'weight_kg' => fake()->randomFloat(2, 1, 100),
            'height_cm' => fake()->randomFloat(2, 1, 100),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
