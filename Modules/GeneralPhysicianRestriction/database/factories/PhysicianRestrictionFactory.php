<?php

namespace Modules\GeneralPhysicianRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralPhysicianRestriction\Models\PhysicianRestriction;

class PhysicianRestrictionFactory extends Factory
{
    protected $model = PhysicianRestriction::class;

    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::factory(),
            'restricted_antibiotic_name' => fake()->randomElement(['Meropenem', 'Vancomycin', 'Colistin']),
            'authorization_level' => fake()->randomElement(PhysicianRestriction::AUTHORIZATION_LEVELS),
            'is_authorized_prescriber' => false,
            'notes' => null,
        ];
    }
}
