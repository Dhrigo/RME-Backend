<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordGynecologyUltrasound\Models\GynecologyUltrasound;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class GynecologyUltrasoundFactory extends Factory
{
    protected $model = GynecologyUltrasound::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'exam_date' => now(),
            'uterus_findings' => 'Normal anteverted uterus, homogenous myometrium',
            'right_ovary_findings' => 'Normal size and echotexture',
            'left_ovary_findings' => 'Normal size and echotexture',
            'endometrial_thickness_mm' => $this->faker->randomFloat(2, 4, 12),
            'conclusion' => 'Normal pelvic pelvic ultrasound',
        ];
    }
}
