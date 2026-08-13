<?php

namespace Modules\LayananRadiologyOrder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;

class RadiologyOrderFactory extends Factory
{
    protected $model = RadiologyOrder::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'ordering_doctor_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'ordered_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'clinical_notes' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
        ];
    }
}
