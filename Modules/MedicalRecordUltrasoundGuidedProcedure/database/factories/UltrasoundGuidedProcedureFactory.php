<?php

namespace Modules\MedicalRecordUltrasoundGuidedProcedure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Models\UltrasoundGuidedProcedure;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class UltrasoundGuidedProcedureFactory extends Factory
{
    protected $model = UltrasoundGuidedProcedure::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'procedure_name' => 'USG Guided Paracentesis',
            'target_site' => 'Right lower quadrant abdomen',
            'needle_gauge' => '18G',
            'findings_and_outcome' => 'Drained 1500ml clear amber ascites fluid under real-time ultrasound guidance',
            'complications' => 'None',
            'performed_at' => now(),
        ];
    }
}
