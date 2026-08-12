<?php

namespace Modules\MedicalRecordDischargeSummary\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDischargeSummary\Models\DischargeSummary;
use Modules\PendaftaranVisit\Models\Visit;

class DischargeSummaryFactory extends Factory
{
    protected $model = DischargeSummary::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'admission_diagnosis_id' => null,
            'discharge_diagnosis_id' => null,
            'treatment_summary' => fake()->sentence(10),
            'condition_at_discharge' => fake()->randomElement(['improved', 'stable', 'recovered']),
            'follow_up_plan' => fake()->sentence(8),
            'discharge_medication' => null,
            'authored_by' => Employee::factory(),
            'authored_at' => now(),
            'created_by' => null,
        ];
    }
}
