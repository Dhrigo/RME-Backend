<?php

namespace Modules\LayananPrescription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;

class PrescriptionFactory extends Factory
{
    protected $model = Prescription::class;

    public function definition(): array
    {
        return [
            'prescription_number' => fake()->unique()->numerify('RX-##########'),
            'visit_id' => Visit::factory(),
            'diagnosis_id' => null,
            'prescribed_by' => Employee::factory(),
            'prescribed_at' => now(),
            'weight_kg' => fake()->randomFloat(2, 3, 90),
            'height_cm' => fake()->randomFloat(2, 50, 180),
            'has_drug_allergy' => false,
            'is_pregnant' => false,
            'is_breastfeeding' => false,
            'is_discharge_prescription' => false,
            'is_emergency' => false,
            'notes' => null,
            'created_by' => null,
            'status' => 'active',
        ];
    }
}
