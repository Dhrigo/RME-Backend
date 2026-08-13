<?php

namespace Modules\MedicalRecordBloodTransfusionObservation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBloodTransfusionObservation\Models\BloodTransfusionObservation;

class BloodTransfusionObservationFactory extends Factory
{
    protected $model = BloodTransfusionObservation::class;

    public function definition(): array
    {
        return [
            'blood_transfusion_id' => 1,
            'observed_at' => now(),
            'temperature_c' => 36.8,
            'pulse_rate' => 80,
            'blood_pressure' => '120/80',
            'reaction_signs' => 'None',
            'volume_transfused_ml' => 50,
            'notes' => null,
        ];
    }
}
