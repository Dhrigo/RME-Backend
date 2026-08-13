<?php

namespace Modules\GeneralReportTypeItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReportType\Models\ReportType;
use Modules\GeneralReportTypeItem\Models\ReportTypeItem;

class ReportTypeItemFactory extends Factory
{
    protected $model = ReportTypeItem::class;

    public function definition(): array
    {
        return [
            'report_type_id' => ReportType::factory(),
            'name' => fake()->randomElement(['RL 3.1 Rawat Inap', 'RL 3.2 Rawat Jalan', 'RL 4a Morbiditas Rawat Inap', 'RL 5.1 Pengunjung']),
            'code' => fake()->unique()->bothify('RL-##'),
            'sequence' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
