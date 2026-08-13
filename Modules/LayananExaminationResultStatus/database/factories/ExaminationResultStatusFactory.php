<?php

namespace Modules\LayananExaminationResultStatus\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananExaminationResultStatus\Models\ExaminationResultStatus;

class ExaminationResultStatusFactory extends Factory
{
    protected $model = ExaminationResultStatus::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'examination_type' => fake()->words(3, true),
            'status' => 'pending',
            'verified_by' => Employee::factory(),
            'verified_at' => now(),
            'notes' => fake()->sentence(),
        ];
    }
}
