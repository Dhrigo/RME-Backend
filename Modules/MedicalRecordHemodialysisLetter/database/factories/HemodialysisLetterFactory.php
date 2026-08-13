<?php

namespace Modules\MedicalRecordHemodialysisLetter\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHemodialysisLetter\Models\HemodialysisLetter;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class HemodialysisLetterFactory extends Factory
{
    protected $model = HemodialysisLetter::class;

    public function definition(): array
    {
        return [
            'letter_number' => 'HD/' . now()->year . '/' . $this->faker->unique()->numberBetween(1000, 9999),
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'issue_date' => now()->toDateString(),
            'diagnosis' => 'Gagal Ginjal Kronik / CKD Stage 5',
            'hd_frequency_per_week' => 2,
            'vascular_access' => 'AV Fistula',
            'remarks' => $this->faker->sentence(),
        ];
    }
}
