<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;

class AntimicrobialStewardshipFormFactory extends Factory
{
    protected $model = AntimicrobialStewardshipForm::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'requesting_doctor_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'antibiotic_restriction_id' => \Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction::factory(),
            'indication' => fake()->paragraph(),
            'status' => fake()->randomElement(['draft', 'submitted', 'approved', 'rejected']),
            'submitted_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
