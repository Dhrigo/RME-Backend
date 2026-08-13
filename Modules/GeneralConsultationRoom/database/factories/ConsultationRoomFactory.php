<?php

namespace Modules\GeneralConsultationRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralConsultationRoom\Models\ConsultationRoom;
use Modules\GeneralWard\Models\Ward;

class ConsultationRoomFactory extends Factory
{
    protected $model = ConsultationRoom::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'consultation_type' => fake()->randomElement(['umum', 'spesialis', 'gigi']),
            'is_active' => true,
        ];
    }
}
