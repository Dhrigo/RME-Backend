<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDischargePlanningScreening\Models\DischargePlanningScreening;

class DischargePlanningScreeningFactory extends Factory
{
    protected $model = DischargePlanningScreening::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'screening_criteria' => fake()->sentence(),
            'total_score' => fake()->numberBetween(1, 10),
            'requires_planning' => false,
            'screened_by' => Employee::factory(),
            'screened_at' => now(),
        ];
    }
}
