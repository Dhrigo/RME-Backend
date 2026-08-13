<?php

namespace Modules\LayananPrescriptionFulfillment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;

class PrescriptionFulfillmentFactory extends Factory
{
    protected $model = PrescriptionFulfillment::class;

    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'served_by' => Employee::factory(),
            'served_at' => now(),
            'status' => 'served',
            'notes' => fake()->sentence(),
        ];
    }
}
