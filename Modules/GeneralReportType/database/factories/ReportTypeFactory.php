<?php

namespace Modules\GeneralReportType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReportType\Models\ReportType;

class ReportTypeFactory extends Factory
{
    protected $model = ReportType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->sentence(3),
            'class_name' => fake()->unique()->word(),
            'module' => fake()->lexify('??????'),
            'level' => 1,
            'is_active' => true,
        ];
    }
}
