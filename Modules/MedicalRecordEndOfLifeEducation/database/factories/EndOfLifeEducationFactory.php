<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEndOfLifeEducation\Models\EndOfLifeEducation;

class EndOfLifeEducationFactory extends Factory
{
    protected $model = EndOfLifeEducation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'topic' => fake()->words(3, true),
            'participants' => fake()->sentence(),
            'decision_summary' => fake()->sentence(),
            'educator_id' => Employee::factory(),
            'educated_at' => now(),
        ];
    }
}
