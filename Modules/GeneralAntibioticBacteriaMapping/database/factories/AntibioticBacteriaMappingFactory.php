<?php

namespace Modules\GeneralAntibioticBacteriaMapping\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralAntibioticBacteriaMapping\Models\AntibioticBacteriaMapping;

class AntibioticBacteriaMappingFactory extends Factory
{
    protected $model = AntibioticBacteriaMapping::class;

    public function definition(): array
    {
        return [
            'antibiotic_name' => fake()->unique()->randomElement(['Ceftriaxone', 'Meropenem', 'Ciprofloxacin', 'Vancomycin', 'Gentamicin', 'Amoxicillin-Clavulanate']),
            'bacteria_name' => fake()->randomElement(['Escherichia coli', 'Klebsiella pneumoniae', 'Staphylococcus aureus', 'Pseudomonas aeruginosa', 'Acinetobacter baumannii']),
            'sensitivity_category' => fake()->randomElement(AntibioticBacteriaMapping::SENSITIVITY_CATEGORIES),
            'is_active' => true,
        ];
    }
}
