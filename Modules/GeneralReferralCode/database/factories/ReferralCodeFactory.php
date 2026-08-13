<?php

namespace Modules\GeneralReferralCode\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReferralCode\Models\ReferralCode;

class ReferralCodeFactory extends Factory
{
    protected $model = ReferralCode::class;

    public function definition(): array
    {
        return [
            'code' => fake()->words(3, true),
            'name' => fake()->words(3, true),
            'category' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
