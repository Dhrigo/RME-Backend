<?php

namespace Modules\GeneralDurationRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDurationRestriction\Models\DurationRestriction;

class DurationRestrictionFactory extends Factory
{
    protected $model = DurationRestriction::class;

    public function definition(): array
    {
        return [
            'antibiotic_name' => fake()->unique()->randomElement(['Meropenem', 'Vancomycin', 'Colistin', 'Ceftriaxone', 'Ciprofloxacin']),
            'max_days' => fake()->numberBetween(5, 14),
            'min_days' => fake()->numberBetween(3, 5),
            'requires_reevaluation' => true,
            'notes' => 'Evaluasi ulang klinis diperlukan setelah durasi maksimum tercapai.',
            'is_active' => true,
        ];
    }
}
