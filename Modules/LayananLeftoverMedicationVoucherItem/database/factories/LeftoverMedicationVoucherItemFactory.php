<?php

namespace Modules\LayananLeftoverMedicationVoucherItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLeftoverMedicationVoucherItem\Models\LeftoverMedicationVoucherItem;

class LeftoverMedicationVoucherItemFactory extends Factory
{
    protected $model = LeftoverMedicationVoucherItem::class;

    public function definition(): array
    {
        return [
            'leftover_medication_voucher_id' => \Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher::factory(),
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'quantity' => fake()->numberBetween(1, 20),
            'unit' => fake()->words(3, true),
        ];
    }
}
