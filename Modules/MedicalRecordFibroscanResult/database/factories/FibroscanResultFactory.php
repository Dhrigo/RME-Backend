<?php

namespace Modules\MedicalRecordFibroscanResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFibroscanResult\Models\FibroscanResult;

class FibroscanResultFactory extends Factory
{
    protected $model = FibroscanResult::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'examination_date' => now()->toDateString(),
            'liver_stiffness_kpa' => fake()->randomFloat(2, 1, 100),
            'cap_score' => fake()->randomFloat(2, 1, 100),
            'fibrosis_stage' => fake()->words(3, true),
            'examined_by' => Employee::factory(),
            'notes' => fake()->sentence(),
        ];
    }
}
