<?php

namespace Modules\GeneralMedicalPersonnel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralMedicalPersonnel\Models\MedicalPersonnel;

class MedicalPersonnelFactory extends Factory
{
    protected $model = MedicalPersonnel::class;

    public function definition(): array
    {
        return [
            'identity_number' => fake()->unique()->numerify('##################'),
            'name' => fake()->name(),
            'personnel_type' => fake()->randomElement([
                'Apoteker', 'Bidan', 'Radiografer', 'Analis Kesehatan', 'Fisioterapis', 'Ahli Gizi', 'Perekam Medis',
            ]),
            'profession_id' => null,
            'license_number' => fake()->numerify('STR-##########'),
            'phone' => fake()->phoneNumber(),
            'is_active' => true,
        ];
    }
}
