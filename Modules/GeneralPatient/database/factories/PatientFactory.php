<?php

namespace Modules\GeneralPatient\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'medical_record_number' => fake()->unique()->numerify('RM-##########'),
            'name' => fake()->name(),
            'nickname' => fake()->firstName(),
            'title_prefix' => null,
            'title_suffix' => null,
            'birth_place' => fake()->city(),
            'birth_date' => fake()->date(),
            'gender_id' => null,
            'religion_id' => null,
            'address' => fake()->address(),
            'rt' => fake()->numerify('##'),
            'rw' => fake()->numerify('##'),
            'postal_code' => fake()->postcode(),
            'village_id' => null,
            'education_id' => null,
            'occupation_id' => null,
            'marital_status_id' => null,
            'blood_type_id' => null,
            'nationality_id' => null,
            'ethnicity_id' => null,
            'language_id' => null,
            'is_unidentified' => false,
            'registered_by' => null,
            'is_active' => true,
        ];
    }

    public function unidentified(): static
    {
        return $this->state(fn () => ['is_unidentified' => true, 'name' => 'Tidak Dikenal']);
    }
}
