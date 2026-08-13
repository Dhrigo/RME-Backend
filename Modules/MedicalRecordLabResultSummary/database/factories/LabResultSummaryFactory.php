<?php

namespace Modules\MedicalRecordLabResultSummary\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordLabResultSummary\Models\LabResultSummary;

class LabResultSummaryFactory extends Factory
{
    protected $model = LabResultSummary::class;

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
