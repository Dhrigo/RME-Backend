<?php

namespace Modules\MedicalRecordProcedureSurgery\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordProcedureSurgery\Models\ProcedureSurgery;

class ProcedureSurgeryFactory extends Factory
{
    protected $model = ProcedureSurgery::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'procedure_id' => 1,
            'surgery_name' => $this->faker->words(3, true),
            'surgery_type' => 'Minor',
            'anesthesia_type' => 'Local',
            'performed_at' => now(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
