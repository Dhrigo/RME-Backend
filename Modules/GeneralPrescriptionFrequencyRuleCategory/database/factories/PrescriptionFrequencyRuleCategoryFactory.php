<?php

namespace Modules\GeneralPrescriptionFrequencyRuleCategory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPrescriptionFrequencyRule\Models\PrescriptionFrequencyRule;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Models\PrescriptionFrequencyRuleCategory;

class PrescriptionFrequencyRuleCategoryFactory extends Factory
{
    protected $model = PrescriptionFrequencyRuleCategory::class;

    public function definition(): array
    {
        return [
            'prescription_frequency_rule_id' => PrescriptionFrequencyRule::factory(),
            'category_name' => fake()->randomElement(['Oral', 'Injeksi', 'Topikal', 'Rutin', 'Jika Perlu (PRN)']),
            'sort_order' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
