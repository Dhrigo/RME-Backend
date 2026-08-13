<?php

namespace Modules\GeneralFormularyRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralFormularyRestriction\Models\FormularyRestriction;

class FormularyRestrictionFactory extends Factory
{
    protected $model = FormularyRestriction::class;

    public function definition(): array
    {
        return [
            'drug_name' => fake()->unique()->randomElement(['Meropenem', 'Vancomycin', 'Colistin', 'Ceftazidime', 'Piperacillin-Tazobactam']),
            'formulary_category' => fake()->randomElement(FormularyRestriction::FORMULARY_CATEGORIES),
            'requires_substitution' => false,
            'substitution_drug_name' => null,
            'notes' => null,
            'is_active' => true,
        ];
    }
}
