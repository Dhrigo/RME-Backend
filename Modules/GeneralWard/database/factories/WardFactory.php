<?php

namespace Modules\GeneralWard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWard\Models\Ward;

class WardFactory extends Factory
{
    protected $model = Ward::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'type_id' => null,
            'visit_type_id' => null,
            'allows_request' => true,
            'created_by' => null,
            'is_active' => true,
        ];
    }
}
