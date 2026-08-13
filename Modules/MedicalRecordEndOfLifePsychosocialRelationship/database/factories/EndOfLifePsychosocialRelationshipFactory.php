<?php

namespace Modules\MedicalRecordEndOfLifePsychosocialRelationship\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Models\EndOfLifePsychosocialRelationship;

class EndOfLifePsychosocialRelationshipFactory extends Factory
{
    protected $model = EndOfLifePsychosocialRelationship::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'relationship_type' => fake()->words(3, true),
            'support_system' => fake()->sentence(),
            'spiritual_needs' => fake()->sentence(),
            'emotional_state' => fake()->words(3, true),
            'assessed_by' => Employee::factory(),
            'assessed_at' => now(),
        ];
    }
}
