<?php

namespace Modules\MedicalRecordPatientTransferSheet\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPatientTransferSheet\Models\PatientTransferSheet;

class PatientTransferSheetFactory extends Factory
{
    protected $model = PatientTransferSheet::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'from_ward_id' => 1,
            'to_ward_id' => 2,
            'transfer_reason' => $this->faker->sentence(),
            'patient_condition' => $this->faker->sentence(),
            'transferred_at' => now(),
            'transferred_by' => 1,
        ];
    }
}
