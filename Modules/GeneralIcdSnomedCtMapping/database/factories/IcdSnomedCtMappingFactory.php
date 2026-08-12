<?php

namespace Modules\GeneralIcdSnomedCtMapping\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralIcdSnomedCtMapping\Models\IcdSnomedCtMapping;

class IcdSnomedCtMappingFactory extends Factory
{
    protected $model = IcdSnomedCtMapping::class;

    public function definition(): array
    {
        return [
            'icd_code' => fake()->unique()->bothify('?##.#'),
            'snomed_code' => fake()->unique()->numerify('#########'),
            'icd_description' => fake()->words(3, true),
            'snomed_description' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
