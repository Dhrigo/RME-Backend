<?php

namespace Modules\PendaftaranReferralLetter\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranReferralLetter\Models\ReferralLetter;
use Modules\PendaftaranVisit\Models\Visit;

class ReferralLetterFactory extends Factory
{
    protected $model = ReferralLetter::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'from_department_id' => MedicalDepartment::factory(),
            'to_department_id' => MedicalDepartment::factory(),
            'issued_at' => $this->faker->dateTimeThisMonth(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
