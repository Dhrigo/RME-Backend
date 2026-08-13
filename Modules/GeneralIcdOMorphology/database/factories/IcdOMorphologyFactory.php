<?php

namespace Modules\GeneralIcdOMorphology\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralIcdOMorphology\Models\IcdOMorphology;

class IcdOMorphologyFactory extends Factory
{
    protected $model = IcdOMorphology::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->numerify('####/#'),
            'is_active' => true,
        ];
    }
}
