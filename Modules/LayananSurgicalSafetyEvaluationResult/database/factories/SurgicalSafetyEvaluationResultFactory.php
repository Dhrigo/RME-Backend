<?php

namespace Modules\LayananSurgicalSafetyEvaluationResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananSurgicalSafetyEvaluationResult\Models\SurgicalSafetyEvaluationResult;

class SurgicalSafetyEvaluationResultFactory extends Factory
{
    protected $model = SurgicalSafetyEvaluationResult::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'operating_room_id' => \Modules\GeneralOperatingRoom\Models\OperatingRoom::factory(),
            'evaluator_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'checklist_score' => fake()->numberBetween(1, 20),
            'compliant' => true,
            'evaluated_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'notes' => fake()->paragraph(),
        ];
    }
}
