<?php

namespace Modules\GeneralAdministration\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralAdministration\Models\Administration;

class AdministrationFactory extends Factory
{
    protected $model = Administration::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
