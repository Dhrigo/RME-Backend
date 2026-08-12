<?php

namespace Modules\GeneralEthnicity\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEthnicity\Models\Ethnicity;

class EthnicityFactory extends Factory
{
    protected $model = Ethnicity::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
