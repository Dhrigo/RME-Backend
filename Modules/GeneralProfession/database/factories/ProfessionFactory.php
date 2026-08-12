<?php

namespace Modules\GeneralProfession\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralProfession\Models\Profession;

class ProfessionFactory extends Factory
{
    protected $model = Profession::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->jobTitle(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
