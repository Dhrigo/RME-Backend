<?php

namespace Modules\LayananBloodRequestItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\LayananBloodRequestItem\Models\BloodRequestItem;

class BloodRequestItemFactory extends Factory
{
    protected $model = BloodRequestItem::class;

    public function definition(): array
    {
        return [
            'blood_transfusion_id' => BloodTransfusion::factory(),
            'blood_component' => fake()->words(3, true),
            'blood_type' => fake()->words(3, true),
            'bag_quantity' => fake()->numberBetween(1, 10),
            'cross_match_result' => fake()->words(3, true),
            'status' => 'pending',
            'notes' => fake()->sentence(),
        ];
    }
}
