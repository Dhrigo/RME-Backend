<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan;
use Modules\MedicalRecordNursingCarePlanImplementation\Models\NursingCarePlanImplementation;

class NursingCarePlanImplementationFactory extends Factory
{
    protected $model = NursingCarePlanImplementation::class;

    public function definition(): array
    {
        return [
            'nursing_care_plan_id' => NursingCarePlan::factory(),
            'action_taken' => fake()->sentence(),
            'performed_by' => Employee::factory(),
            'performed_at' => now(),
            'evaluation' => fake()->sentence(),
        ];
    }
}
