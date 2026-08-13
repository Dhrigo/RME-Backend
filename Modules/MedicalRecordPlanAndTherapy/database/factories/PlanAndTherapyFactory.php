<?php

namespace Modules\MedicalRecordPlanAndTherapy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPlanAndTherapy\Models\PlanAndTherapy;

class PlanAndTherapyFactory extends Factory
{
    protected $model = PlanAndTherapy::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'ordered_by' => \Modules\GeneralDoctor\Models\Doctor::factory(),
            'created_by' => null,
            'assessment_summary' => fake()->sentence(8),
            'plan_description' => fake()->sentence(10),
            'therapy_type' => fake()->randomElement(['pharmacological','physical_therapy','surgical','dietary']),
            'target_date' => null,
            'status' => 'active',
            'ordered_at' => now(),
        ];
    }
}
