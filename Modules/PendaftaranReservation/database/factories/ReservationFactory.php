<?php

namespace Modules\PendaftaranReservation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranReservation\Models\Reservation;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'ward_id' => Ward::factory(),
            'reserved_at' => $this->faker->dateTimeThisMonth(),
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
        ];
    }
}
