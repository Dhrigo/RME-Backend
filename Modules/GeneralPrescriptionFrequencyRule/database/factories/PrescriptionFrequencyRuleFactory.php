<?php

namespace Modules\GeneralPrescriptionFrequencyRule\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPrescriptionFrequencyRule\Models\PrescriptionFrequencyRule;

class PrescriptionFrequencyRuleFactory extends Factory
{
    protected $model = PrescriptionFrequencyRule::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->randomElement(['1x1', '2x1', '3x1', '4x1', '1x2', 'prn']),
            'description' => fake()->randomElement(['Sekali sehari', 'Dua kali sehari', 'Tiga kali sehari', 'Empat kali sehari', 'Jika perlu']),
            'times_per_day' => fake()->numberBetween(1, 4),
            'interval_hours' => fake()->randomElement([24, 12, 8, 6, null]),
            'is_active' => true,
        ];
    }
}
