<?php

namespace Modules\MedicalRecordRadiologyResultSummaryItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordRadiologyResultSummaryItem\Models\RadiologyResultSummaryItem;

class RadiologyResultSummaryItemFactory extends Factory
{
    protected $model = RadiologyResultSummaryItem::class;

    public function definition(): array
    {
        return [
            'summary_id' => \Modules\MedicalRecordRadiologyResultSummary\Models\RadiologyResultSummary::factory(),
            'exam_name' => fake()->randomElement(['Thorax PA','CT Scan Kepala','USG Abdomen','MRI Lumbal']),
            'finding' => fake()->sentence(8),
            'impression' => fake()->sentence(6),
            'performed_at' => now(),
        ];
    }
}
