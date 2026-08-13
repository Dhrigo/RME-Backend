<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPrescriptionOriginUnitRestriction\Models\PrescriptionOriginUnitRestriction;

class PrescriptionOriginUnitRestrictionFactory extends Factory
{
    protected $model = PrescriptionOriginUnitRestriction::class;

    public function definition(): array
    {
        return [
            'ward_id' => \Modules\GeneralWard\Models\Ward::factory(),
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'is_allowed' => true,
            'note' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
