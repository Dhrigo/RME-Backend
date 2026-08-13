<?php

namespace Modules\MedicalRecordOtherHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordOtherHistory\Models\OtherHistory;

class OtherHistoryFactory extends Factory
{
    protected $model = OtherHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'recorded_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'category' => fake()->words(2,true),
            'description' => fake()->sentence(8),
            'recorded_at' => now(),
        ];
    }
}
