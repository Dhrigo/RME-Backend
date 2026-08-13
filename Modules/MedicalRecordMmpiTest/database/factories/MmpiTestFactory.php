<?php

namespace Modules\MedicalRecordMmpiTest\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordMmpiTest\Models\MmpiTest;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class MmpiTestFactory extends Factory
{
    protected $model = MmpiTest::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'test_date' => now(),
            'validity_scale_l' => $this->faker->numberBetween(40, 65),
            'validity_scale_f' => $this->faker->numberBetween(40, 65),
            'validity_scale_k' => $this->faker->numberBetween(40, 65),
            'clinical_scales_summary' => ['Hs' => 50, 'D' => 55, 'Hy' => 48, 'Pd' => 52],
            'interpretation' => 'Valid profile within normal limits',
            'conclusion' => 'No pathological psychological traits identified',
        ];
    }
}
