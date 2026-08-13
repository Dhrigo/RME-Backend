<?php

namespace Modules\MedicalRecordBirthCertificateLetter\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBirthCertificateLetter\Models\BirthCertificateLetter;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class BirthCertificateLetterFactory extends Factory
{
    protected $model = BirthCertificateLetter::class;

    public function definition(): array
    {
        return [
            'letter_number' => 'BIRTH/' . now()->year . '/' . $this->faker->unique()->numberBetween(1000, 9999),
            'patient_id' => Patient::factory(),
            'mother_patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'issue_date' => now()->toDateString(),
            'child_name' => $this->faker->name(),
            'birth_date_time' => now(),
            'birth_weight_grams' => $this->faker->numberBetween(2500, 3800),
            'birth_length_cm' => $this->faker->randomFloat(2, 46, 52),
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'remarks' => $this->faker->sentence(),
        ];
    }
}
