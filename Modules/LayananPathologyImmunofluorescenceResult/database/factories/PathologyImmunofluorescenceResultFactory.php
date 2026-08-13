<?php

namespace Modules\LayananPathologyImmunofluorescenceResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPathologyImmunofluorescenceResult\Models\PathologyImmunofluorescenceResult;

class PathologyImmunofluorescenceResultFactory extends Factory
{
    protected $model = PathologyImmunofluorescenceResult::class;

    public function definition(): array
    {
        return [
            'pathology_anatomy_result_id' => \Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult::factory(),
            'marker' => fake()->words(3, true),
            'result' => fake()->words(3, true),
            'intensity' => fake()->words(3, true),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
