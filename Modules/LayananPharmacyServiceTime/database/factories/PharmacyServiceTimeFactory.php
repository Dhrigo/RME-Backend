<?php

namespace Modules\LayananPharmacyServiceTime\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime;

class PharmacyServiceTimeFactory extends Factory
{
    protected $model = PharmacyServiceTime::class;

    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'received_at' => now(),
            'prepared_at' => now(),
            'dispensed_at' => now(),
            'status' => 'pending',
        ];
    }
}
