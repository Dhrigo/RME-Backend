<?php

namespace Modules\LayananBirthRecord\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananBirthRecord\Models\BirthRecord;

class BirthRecordFactory extends Factory
{
    protected $model = BirthRecord::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'mother_patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'baby_name' => fake()->words(3, true),
            'gender_id' => \Modules\GeneralGender\Models\Gender::factory(),
            'birth_date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'birth_weight_grams' => fake()->numberBetween(1, 20),
            'birth_length_cm' => fake()->randomFloat(1, 1, 100),
            'delivery_method' => fake()->randomElement(['normal', 'cesarean', 'assisted']),
            'attending_doctor_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'notes' => fake()->paragraph(),
        ];
    }
}
