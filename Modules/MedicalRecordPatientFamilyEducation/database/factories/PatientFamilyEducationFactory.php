<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPatientFamilyEducation\Models\PatientFamilyEducation;

class PatientFamilyEducationFactory extends Factory
{
    protected $model = PatientFamilyEducation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'topic' => fake()->words(3, true),
            'method' => fake()->words(3, true),
            'barrier' => fake()->sentence(),
            'understanding_level' => fake()->words(3, true),
            're_education_needed' => false,
            'educator_id' => Employee::factory(),
            'educated_at' => now(),
        ];
    }
}
