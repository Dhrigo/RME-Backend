<?php

namespace Modules\LayananAntimicrobialStewardshipRadiologyResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipRadiologyResult\Models\AntimicrobialStewardshipRadiologyResult;

class AntimicrobialStewardshipRadiologyResultFactory extends Factory
{
    protected $model = AntimicrobialStewardshipRadiologyResult::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'examination_name' => fake()->words(3, true),
            'findings' => fake()->paragraph(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
