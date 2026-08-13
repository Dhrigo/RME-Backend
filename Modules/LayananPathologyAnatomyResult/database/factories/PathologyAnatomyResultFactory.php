<?php

namespace Modules\LayananPathologyAnatomyResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;

class PathologyAnatomyResultFactory extends Factory
{
    protected $model = PathologyAnatomyResult::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'specimen_description' => fake()->paragraph(),
            'macroscopic_finding' => fake()->paragraph(),
            'microscopic_finding' => fake()->paragraph(),
            'diagnosis' => fake()->paragraph(),
            'examined_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'status' => fake()->randomElement(['pending', 'final']),
        ];
    }
}
