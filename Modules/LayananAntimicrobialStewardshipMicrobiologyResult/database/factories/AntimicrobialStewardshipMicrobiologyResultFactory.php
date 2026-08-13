<?php

namespace Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Models\AntimicrobialStewardshipMicrobiologyResult;

class AntimicrobialStewardshipMicrobiologyResultFactory extends Factory
{
    protected $model = AntimicrobialStewardshipMicrobiologyResult::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'specimen_type' => fake()->words(3, true),
            'organism_found' => fake()->words(3, true),
            'sensitivity_result' => fake()->paragraph(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
