<?php

namespace Modules\MedicalRecordBloodTransfusionDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBloodTransfusionDetail\Models\BloodTransfusionDetail;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;

class BloodTransfusionDetailFactory extends Factory
{
    protected $model = BloodTransfusionDetail::class;

    public function definition(): array
    {
        return [
            'transfusion_id' => BloodTransfusion::factory(),
            'blood_bag_number' => 'BAG-' . $this->faker->unique()->numberBetween(10000, 99999),
            'blood_type' => $this->faker->randomElement(['A+', 'B+', 'O+', 'AB+']),
            'volume_ml' => 350,
            'start_time' => now(),
            'end_time' => now()->addHours(2),
            'reaction_observed' => 'None',
            'status' => 'Completed',
        ];
    }
}
