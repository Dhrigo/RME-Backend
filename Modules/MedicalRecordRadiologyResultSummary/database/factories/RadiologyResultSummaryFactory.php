<?php

namespace Modules\MedicalRecordRadiologyResultSummary\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordRadiologyResultSummary\Models\RadiologyResultSummary;

class RadiologyResultSummaryFactory extends Factory
{
    protected $model = RadiologyResultSummary::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'summarized_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'overall_impression' => fake()->sentence(8),
            'summarized_at' => now(),
        ];
    }
}
