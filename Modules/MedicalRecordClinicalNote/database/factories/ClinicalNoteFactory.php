<?php

namespace Modules\MedicalRecordClinicalNote\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\PendaftaranVisit\Models\Visit;

class ClinicalNoteFactory extends Factory
{
    protected $model = ClinicalNote::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'recorded_at' => now(),
            'subjective' => fake()->sentence(10),
            'objective' => fake()->sentence(10),
            'assessment' => fake()->sentence(6),
            'planning' => fake()->sentence(6),
            'instructions' => null,
            'note_type' => 'progress',
            'author_id' => Employee::factory(),
            'sub_division' => null,
            'has_discharge_plan' => false,
            'discharge_plan_date' => null,
            'created_by' => null,
            'status' => 'active',
        ];
    }
}
