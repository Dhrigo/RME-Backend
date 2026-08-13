<?php

namespace Modules\LayananPrescriptionInitialReview\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionInitialReview\Models\PrescriptionInitialReview;

class PrescriptionInitialReviewFactory extends Factory
{
    protected $model = PrescriptionInitialReview::class;

    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'reviewed_by' => Employee::factory(),
            'reviewed_at' => now(),
            'is_appropriate' => true,
            'issues_found' => fake()->sentence(),
            'recommendation' => fake()->sentence(),
            'status' => 'reviewed',
        ];
    }
}
