<?php

namespace Modules\MedicalRecordAllergy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\MedicalRecordAllergy\Models\Allergy;

class AllergyFactory extends Factory
{
    protected $model = Allergy::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'category' => fake()->randomElement(['drug', 'food', 'environment']),
            'allergen' => fake()->randomElement(['Penicillin', 'Seafood', 'Peanuts', 'Dust', 'Sulfa drugs']),
            'reaction' => fake()->randomElement(['Rash', 'Anaphylaxis', 'Swelling', 'Itching']),
            'severity' => fake()->randomElement(['mild', 'moderate', 'severe']),
            'is_active' => true,
            'recorded_by' => Employee::factory(),
            'created_by' => null,
        ];
    }
}
