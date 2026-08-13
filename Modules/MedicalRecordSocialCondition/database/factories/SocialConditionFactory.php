<?php

namespace Modules\MedicalRecordSocialCondition\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordSocialCondition\Models\SocialCondition;

class SocialConditionFactory extends Factory
{
    protected $model = SocialCondition::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'living_situation' => fake()->words(3, true),
            'occupation_status' => fake()->words(3, true),
            'financial_status' => fake()->words(3, true),
            'support_system' => fake()->sentence(),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
