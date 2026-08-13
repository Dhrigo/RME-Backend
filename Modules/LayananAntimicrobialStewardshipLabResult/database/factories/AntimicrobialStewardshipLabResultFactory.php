<?php

namespace Modules\LayananAntimicrobialStewardshipLabResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipLabResult\Models\AntimicrobialStewardshipLabResult;

class AntimicrobialStewardshipLabResultFactory extends Factory
{
    protected $model = AntimicrobialStewardshipLabResult::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'lab_result_id' => \Modules\LayananLabResult\Models\LabResult::factory(),
            'examination_name' => fake()->words(3, true),
            'result_value' => fake()->words(3, true),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
