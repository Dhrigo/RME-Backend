<?php

namespace Modules\GeneralProcedure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralProcedure\Models\Procedure;

class ProcedureFactory extends Factory
{
    protected $model = Procedure::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->lexify('???'),
            'name' => fake()->unique()->words(3, true),
            'is_active' => true,
        ];
    }
}
