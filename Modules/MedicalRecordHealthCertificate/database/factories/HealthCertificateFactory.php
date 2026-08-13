<?php

namespace Modules\MedicalRecordHealthCertificate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHealthCertificate\Models\HealthCertificate;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class HealthCertificateFactory extends Factory
{
    protected $model = HealthCertificate::class;

    public function definition(): array
    {
        return [
            'letter_number' => 'SEHAT/' . now()->year . '/' . $this->faker->unique()->numberBetween(1000, 9999),
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'issue_date' => now()->toDateString(),
            'physical_fitness_status' => 'Sehat / Fit',
            'purpose' => 'Persyaratan Kerja / Employment Requirements',
            'blood_pressure' => '120/80 mmHg',
            'height_cm' => $this->faker->randomFloat(2, 150, 185),
            'weight_kg' => $this->faker->randomFloat(2, 50, 90),
            'remarks' => $this->faker->sentence(),
        ];
    }
}
