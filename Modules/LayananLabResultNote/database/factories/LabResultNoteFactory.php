<?php

namespace Modules\LayananLabResultNote\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabResultNote\Models\LabResultNote;

class LabResultNoteFactory extends Factory
{
    protected $model = LabResultNote::class;

    public function definition(): array
    {
        return [
            'lab_result_id' => \Modules\LayananLabResult\Models\LabResult::factory(),
            'note' => fake()->paragraph(),
            'created_by' => \Modules\Auth\Models\User::factory(),
        ];
    }
}
