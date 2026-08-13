<?php

namespace Modules\MedicalRecordNursingCarePlan\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan;

class NursingCarePlanFactory extends Factory
{
    protected $model = NursingCarePlan::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'assessment' => fake()->sentence(),
            'goal' => fake()->sentence(),
            'intervention_plan' => fake()->sentence(),
            'target_date' => now()->toDateString(),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
            'status' => 'active',
        ];
    }
}
