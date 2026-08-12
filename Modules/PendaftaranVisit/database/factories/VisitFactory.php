<?php

namespace Modules\PendaftaranVisit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;

class VisitFactory extends Factory
{
    protected $model = Visit::class;

    public function definition(): array
    {
        return [
            'visit_number' => fake()->unique()->numerify('KJ-##########'),
            'registration_id' => Registration::factory(),
            'attending_physician_id' => null,
            'ward_id' => null,
            'bed_id' => null,
            'admitted_at' => now(),
            'discharged_at' => null,
            'is_new_visit' => true,
            'is_deposit' => false,
            'deposit_class_id' => null,
            'received_by' => null,
            'final_outcome' => null,
            'final_outcome_by' => null,
            'final_outcome_at' => null,
            'status' => 'active',
        ];
    }

    public function discharged(): static
    {
        return $this->state(fn () => [
            'discharged_at' => now(),
            'final_outcome' => 'sembuh',
            'status' => 'discharged',
        ]);
    }
}
