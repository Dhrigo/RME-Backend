<?php

namespace Modules\LayananAntimicrobialStewardshipApproval\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipApproval\Models\AntimicrobialStewardshipApproval;

class AntimicrobialStewardshipApprovalFactory extends Factory
{
    protected $model = AntimicrobialStewardshipApproval::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'approved_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'decision' => fake()->randomElement(['approved', 'rejected']),
            'decision_note' => fake()->paragraph(),
            'decided_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
