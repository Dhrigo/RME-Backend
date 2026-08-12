<?php

namespace Modules\GeneralReligion\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReligion\Models\Religion;

class ReligionFactory extends Factory
{
    protected $model = Religion::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
