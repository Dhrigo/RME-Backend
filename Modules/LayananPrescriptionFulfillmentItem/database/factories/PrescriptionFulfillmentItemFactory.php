<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPrescriptionFulfillmentItem\Models\PrescriptionFulfillmentItem;

class PrescriptionFulfillmentItemFactory extends Factory
{
    protected $model = PrescriptionFulfillmentItem::class;

    public function definition(): array
    {
        return [
            'prescription_fulfillment_id' => PrescriptionFulfillment::factory(),
            'prescription_item_id' => PrescriptionItem::factory(),
            'quantity_served' => fake()->numberBetween(1, 10),
            'is_substituted' => false,
            'notes' => fake()->sentence(),
        ];
    }
}
