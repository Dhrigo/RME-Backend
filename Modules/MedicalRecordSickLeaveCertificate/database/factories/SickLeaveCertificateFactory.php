<?php

namespace Modules\MedicalRecordSickLeaveCertificate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordSickLeaveCertificate\Models\SickLeaveCertificate;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class SickLeaveCertificateFactory extends Factory
{
    protected $model = SickLeaveCertificate::class;

    public function definition(): array
    {
        $startDate = now();
        $duration = $this->faker->numberBetween(1, 3);
        $endDate = (clone $startDate)->addDays($duration - 1);

        return [
            'letter_number' => 'SK/' . now()->year . '/' . $this->faker->unique()->numberBetween(1000, 9999),
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'issue_date' => $startDate->toDateString(),
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'duration_days' => $duration,
            'diagnosis' => 'Acute Upper Respiratory Tract Infection',
            'remarks' => $this->faker->sentence(),
        ];
    }
}
