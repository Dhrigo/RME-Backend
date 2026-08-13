<?php

namespace Modules\GeneralPatientAccessLock\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientAccessLock\Models\PatientAccessLock;

class PatientAccessLockFactory extends Factory
{
    protected $model = PatientAccessLock::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'locked_by' => null,
            'reason' => fake()->randomElement([
                'Permintaan penegakan hukum',
                'Sengketa hak asuh anak',
                'Permintaan pasien VIP untuk kerahasiaan tambahan',
            ]),
            'locked_at' => now(),
            'unlocked_at' => null,
            'is_active' => true,
        ];
    }
}
