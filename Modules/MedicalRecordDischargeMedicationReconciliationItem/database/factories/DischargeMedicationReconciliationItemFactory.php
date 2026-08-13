<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliationItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordDischargeMedicationReconciliationItem\Models\DischargeMedicationReconciliationItem;

class DischargeMedicationReconciliationItemFactory extends Factory
{
    protected $model = DischargeMedicationReconciliationItem::class;

    public function definition(): array
    {
        return [
            'reconciliation_id' => \Modules\MedicalRecordDischargeMedicationReconciliation\Models\DischargeMedicationReconciliation::factory(),
            'drug_name' => fake()->word(),
            'dose' => fake()->numberBetween(1,500).'mg',
            'frequency' => fake()->randomElement(['1x1','2x1','3x1','prn']),
            'route' => fake()->randomElement(['oral','iv','im','sc','topical']),
            'action' => fake()->randomElement(['continue','hold','discontinue','modify','new']),
            'reason' => null,
            'patient_education_given' => fake()->boolean(),
        ];
    }
}
