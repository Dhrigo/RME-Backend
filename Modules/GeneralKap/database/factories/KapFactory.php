<?php

namespace Modules\GeneralKap\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralKap\Models\Kap;

class KapFactory extends Factory
{
    protected $model = Kap::class;

    public function definition(): array
    {
        return [
            'patient_norm' => fake()->unique()->numerify('##########'),
            'card_type' => fake()->randomElement(['BPJS', 'KIS', 'Asuransi Swasta']),
            'card_number' => fake()->numerify('##################'),
        ];
    }
}
