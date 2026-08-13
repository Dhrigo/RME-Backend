<?php

namespace Modules\MedicalRecordHospitalizationCertificate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHospitalizationCertificate\Models\HospitalizationCertificate;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class HospitalizationCertificateFactory extends Factory
{
    protected $model = HospitalizationCertificate::class;

    public function definition(): array
    {
        return [
            'letter_number' => 'OPNAME/' . now()->year . '/' . $this->faker->unique()->numberBetween(1000, 9999),
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'issue_date' => now()->toDateString(),
            'admission_date' => now()->toDateString(),
            'estimated_duration_days' => $this->faker->numberBetween(3, 7),
            'ward_name' => 'Ruang Melati Class 1',
            'diagnosis' => 'Dengue Hemorrhagic Fever',
            'remarks' => $this->faker->sentence(),
        ];
    }
}
