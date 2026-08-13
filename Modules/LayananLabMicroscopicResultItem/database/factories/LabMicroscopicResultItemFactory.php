<?php

namespace Modules\LayananLabMicroscopicResultItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabMicroscopicResultItem\Models\LabMicroscopicResultItem;

class LabMicroscopicResultItemFactory extends Factory
{
    protected $model = LabMicroscopicResultItem::class;

    public function definition(): array
    {
        return [
            'lab_microscopic_result_id' => \Modules\LayananLabMicroscopicResult\Models\LabMicroscopicResult::factory(),
            'parameter_name' => fake()->words(3, true),
            'value' => fake()->words(3, true),
        ];
    }
}
