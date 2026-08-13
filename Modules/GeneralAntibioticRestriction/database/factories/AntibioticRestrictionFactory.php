<?php

namespace Modules\GeneralAntibioticRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction;

class AntibioticRestrictionFactory extends Factory
{
    protected $model = AntibioticRestriction::class;

    public function definition(): array
    {
        return [
            'antibiotic_name' => fake()->unique()->randomElement(['Meropenem', 'Vancomycin', 'Colistin', 'Ceftriaxone', 'Ciprofloxacin', 'Amikacin']),
            'aware_category' => fake()->randomElement(AntibioticRestriction::AWARE_CATEGORIES),
            'requires_pra_approval' => fake()->boolean(),
            'restriction_condition' => 'Perlu persetujuan Tim Pengendali Resistensi Antimikroba (PPRA) sebelum diresepkan.',
            'is_active' => true,
        ];
    }
}
