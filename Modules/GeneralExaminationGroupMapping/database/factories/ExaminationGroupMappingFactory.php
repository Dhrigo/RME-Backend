<?php

namespace Modules\GeneralExaminationGroupMapping\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralExaminationGroup\Models\ExaminationGroup;
use Modules\GeneralExaminationGroupMapping\Models\ExaminationGroupMapping;

class ExaminationGroupMappingFactory extends Factory
{
    protected $model = ExaminationGroupMapping::class;

    public function definition(): array
    {
        return [
            'examination_group_id' => ExaminationGroup::factory(),
            'mapping_category' => fake()->randomElement(['Laboratorium', 'Radiologi', 'Elektromedik']),
            'external_code' => fake()->optional()->bothify('EXG-####'),
            'is_active' => true,
        ];
    }
}
