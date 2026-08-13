<?php

namespace Modules\MedicalRecordAdmissionMedicationReconciliationItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Models\AdmissionMedicationReconciliationItem;

class AdmissionMedicationReconciliationItemFactory extends Factory
{
    protected $model = AdmissionMedicationReconciliationItem::class;

    public function definition(): array
    {
        return [
            'reconciliation_id' => \Modules\MedicalRecordAdmissionMedicationReconciliation\Models\AdmissionMedicationReconciliation::factory(),
            'drug_name' => fake()->word(),
            'dose' => fake()->numberBetween(1,500).'mg',
            'frequency' => fake()->randomElement(['1x1','2x1','3x1','prn']),
            'route' => fake()->randomElement(['oral','iv','im','sc','topical']),
            'action' => fake()->randomElement(['continue','hold','discontinue','modify','new']),
            'reason' => null,
            'last_taken_at' => null,
        ];
    }
}
