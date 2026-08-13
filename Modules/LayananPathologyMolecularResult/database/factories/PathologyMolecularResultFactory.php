<?php

namespace Modules\LayananPathologyMolecularResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPathologyMolecularResult\Models\PathologyMolecularResult;

class PathologyMolecularResultFactory extends Factory
{
    protected $model = PathologyMolecularResult::class;

    public function definition(): array
    {
        return [
            'pathology_anatomy_result_id' => \Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult::factory(),
            'test_name' => fake()->words(3, true),
            'result' => fake()->paragraph(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
