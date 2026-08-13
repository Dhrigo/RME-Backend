<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordDischargeMedicationReconciliation\Models\DischargeMedicationReconciliation;

class DischargeMedicationReconciliationFactory extends Factory
{
    protected $model = DischargeMedicationReconciliation::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'reconciled_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'source_of_medication_list' => fake()->randomElement(['patient','family','previous_records','pharmacy']),
            'notes' => null,
            'status' => 'draft',
            'reconciled_at' => now(),
        ];
    }
}
