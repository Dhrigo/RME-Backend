<?php

namespace Modules\LayananAntimicrobialStewardshipOtherSupportResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipOtherSupportResult\Models\AntimicrobialStewardshipOtherSupportResult;

class AntimicrobialStewardshipOtherSupportResultFactory extends Factory
{
    protected $model = AntimicrobialStewardshipOtherSupportResult::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'examination_name' => fake()->words(3, true),
            'result_value' => fake()->paragraph(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
