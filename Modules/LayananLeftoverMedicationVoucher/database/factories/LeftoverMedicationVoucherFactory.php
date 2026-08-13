<?php

namespace Modules\LayananLeftoverMedicationVoucher\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;

class LeftoverMedicationVoucherFactory extends Factory
{
    protected $model = LeftoverMedicationVoucher::class;

    public function definition(): array
    {
        return [
            'voucher_number' => fake()->words(3, true),
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory(),
            'status' => fake()->randomElement(['pending', 'redeemed', 'expired']),
            'issued_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'redeemed_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'notes' => fake()->paragraph(),
        ];
    }
}
