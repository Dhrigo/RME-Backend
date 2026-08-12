<?php

namespace Modules\LayananPrescriptionItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;

class PrescriptionItemFactory extends Factory
{
    protected $model = PrescriptionItem::class;

    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'drug_name' => fake()->randomElement(['Paracetamol 500mg', 'Amoxicillin 500mg', 'Omeprazole 20mg']),
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
            'route' => 'Oral',
            'duration' => '5 hari',
            'quantity' => 15,
            'notes' => null,
        ];
    }
}
