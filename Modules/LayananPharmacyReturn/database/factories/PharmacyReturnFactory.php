<?php

namespace Modules\LayananPharmacyReturn\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPharmacyReturn\Models\PharmacyReturn;

class PharmacyReturnFactory extends Factory
{
    protected $model = PharmacyReturn::class;

    public function definition(): array
    {
        return [
            'prescription_item_id' => PrescriptionItem::factory(),
            'quantity_returned' => fake()->numberBetween(1, 10),
            'reason' => fake()->words(3, true),
            'returned_by' => Employee::factory(),
            'returned_at' => now(),
            'status' => 'pending',
        ];
    }
}
