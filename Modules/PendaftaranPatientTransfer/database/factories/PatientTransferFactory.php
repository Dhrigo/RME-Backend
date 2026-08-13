<?php

namespace Modules\PendaftaranPatientTransfer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranPatientTransfer\Models\PatientTransfer;
use Modules\PendaftaranVisit\Models\Visit;

class PatientTransferFactory extends Factory
{
    protected $model = PatientTransfer::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'from_ward_id' => Ward::factory(),
            'to_ward_id' => Ward::factory(),
            'transferred_at' => $this->faker->dateTimeThisMonth(),
            'reason' => $this->faker->sentence(),
        ];
    }
}
