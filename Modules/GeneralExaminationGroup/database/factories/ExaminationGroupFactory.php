<?php

namespace Modules\GeneralExaminationGroup\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralExaminationGroup\Models\ExaminationGroup;

class ExaminationGroupFactory extends Factory
{
    protected $model = ExaminationGroup::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
