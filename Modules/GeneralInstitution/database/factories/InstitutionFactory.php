<?php

namespace Modules\GeneralInstitution\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralInstitution\Models\Institution;

class InstitutionFactory extends Factory
{
    protected $model = Institution::class;

    public function definition(): array
    {
        return [
            'ppk_id' => fake()->unique()->numberBetween(1, 1000000),
            'email' => fake()->unique()->companyEmail(),
            'website' => fake()->unique()->domainName(),
        ];
    }
}
