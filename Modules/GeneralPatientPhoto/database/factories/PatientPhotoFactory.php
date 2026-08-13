<?php

namespace Modules\GeneralPatientPhoto\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;

class PatientPhotoFactory extends Factory
{
    protected $model = PatientPhoto::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'file_path' => 'patient-photos/'.fake()->uuid().'.jpg',
            'taken_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
