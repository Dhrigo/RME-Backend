<?php

namespace Modules\GeneralPpk\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPpk\Models\Ppk;

class PpkFactory extends Factory
{
    protected $model = Ppk::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->numerify('PPK#######'),
            'bpjs_code' => fake()->numerify('########'),
            'type' => fake()->numberBetween(1, 5),
            'ownership' => fake()->numberBetween(1, 5),
            'jpk' => fake()->numberBetween(1, 3),
            'name' => fake()->company(),
            'class' => fake()->randomElement(['A', 'B', 'C', 'D']),
            'address' => fake()->address(),
            'rt' => fake()->numerify('###'),
            'rw' => fake()->numerify('###'),
            'postal_code' => fake()->numerify('#####'),
            'phone' => fake()->phoneNumber(),
            'fax' => fake()->phoneNumber(),
            'region_code' => fake()->numerify('##.##'),
            'region_name' => fake()->city(),
            'started_at' => fake()->dateTimeBetween('-5 years', 'now'),
            'ended_at' => null,
            'is_active' => true,
        ];
    }
}
