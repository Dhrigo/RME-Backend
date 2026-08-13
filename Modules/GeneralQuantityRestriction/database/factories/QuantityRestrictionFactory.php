<?php

namespace Modules\GeneralQuantityRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralQuantityRestriction\Models\QuantityRestriction;

class QuantityRestrictionFactory extends Factory
{
    protected $model = QuantityRestriction::class;

    public function definition(): array
    {
        return [
            'drug_name' => fake()->unique()->randomElement(['Meropenem', 'Vancomycin', 'Colistin', 'Ceftriaxone', 'Ciprofloxacin']),
            'max_quantity_per_prescription' => fake()->numberBetween(10, 30),
            'unit' => fake()->randomElement(['tablet', 'vial', 'ampul', 'botol']),
            'notes' => null,
            'is_active' => true,
        ];
    }
}
