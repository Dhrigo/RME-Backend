<?php

namespace Modules\LayananMedicationServiceLimit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananMedicationServiceLimit\Models\MedicationServiceLimit;

class MedicationServiceLimitFactory extends Factory
{
    protected $model = MedicationServiceLimit::class;

    public function definition(): array
    {
        return [
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'guarantor_type' => fake()->words(3, true),
            'max_quantity_per_month' => fake()->numberBetween(1, 20),
            'max_days_supply' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
