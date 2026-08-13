<?php

namespace Modules\MedicalRecordInpatientCarePlan\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordInpatientCarePlan\Models\InpatientCarePlan;

class InpatientCarePlanFactory extends Factory
{
    protected $model = InpatientCarePlan::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'planned_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'care_goals' => fake()->sentence(10),
            'planned_length_of_stay_days' => fake()->numberBetween(1,14),
            'discharge_criteria' => fake()->sentence(8),
            'status' => 'active',
            'planned_at' => now(),
        ];
    }
}
