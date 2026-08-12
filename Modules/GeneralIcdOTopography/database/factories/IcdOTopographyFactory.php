<?php

namespace Modules\GeneralIcdOTopography\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralIcdOTopography\Models\IcdOTopography;

class IcdOTopographyFactory extends Factory
{
    protected $model = IcdOTopography::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->bothify('C##.#'),
            'is_active' => true,
        ];
    }
}
