<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation;

class TransferMedicationReconciliationFactory extends Factory
{
    protected $model = TransferMedicationReconciliation::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'reconciled_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'transferred_to_ward_id' => \Modules\GeneralWard\Models\Ward::factory(),
            'source_of_medication_list' => fake()->randomElement(['patient','family','previous_records','pharmacy']),
            'notes' => null,
            'status' => 'draft',
            'reconciled_at' => now(),
        ];
    }
}
