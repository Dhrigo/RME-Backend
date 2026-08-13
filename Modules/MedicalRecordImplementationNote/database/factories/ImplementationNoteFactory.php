<?php

namespace Modules\MedicalRecordImplementationNote\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImplementationNote\Models\ImplementationNote;

class ImplementationNoteFactory extends Factory
{
    protected $model = ImplementationNote::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'note_type' => fake()->words(3, true),
            'content' => fake()->sentence(),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
