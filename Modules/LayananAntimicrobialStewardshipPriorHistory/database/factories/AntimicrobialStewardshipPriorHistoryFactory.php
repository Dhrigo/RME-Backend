<?php

namespace Modules\LayananAntimicrobialStewardshipPriorHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipPriorHistory\Models\AntimicrobialStewardshipPriorHistory;

class AntimicrobialStewardshipPriorHistoryFactory extends Factory
{
    protected $model = AntimicrobialStewardshipPriorHistory::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'previous_antibiotic' => fake()->words(3, true),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'outcome' => fake()->words(3, true),
            'notes' => fake()->paragraph(),
        ];
    }
}
