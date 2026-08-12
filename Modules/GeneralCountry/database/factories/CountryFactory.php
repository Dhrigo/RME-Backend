<?php

namespace Modules\GeneralCountry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralCountry\Models\Country;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
