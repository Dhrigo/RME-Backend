<?php

namespace Modules\GeneralKip\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralKip\Models\Kip;

class KipFactory extends Factory
{
    protected $model = Kip::class;

    public function definition(): array
    {
        return [
            'patient_norm' => fake()->unique()->numerify('##########'),
            'card_type' => fake()->randomElement(['KTP', 'KIA', 'Paspor']),
            'card_number' => fake()->numerify('################'),
            'address' => fake()->address(),
            'rt' => fake()->numerify('###'),
            'rw' => fake()->numerify('###'),
            'postal_code' => fake()->numerify('#####'),
            'region_code' => fake()->numerify('##.##'),
        ];
    }
}
