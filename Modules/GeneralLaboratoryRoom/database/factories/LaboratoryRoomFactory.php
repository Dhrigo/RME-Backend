<?php

namespace Modules\GeneralLaboratoryRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralLaboratoryRoom\Models\LaboratoryRoom;
use Modules\GeneralWard\Models\Ward;

class LaboratoryRoomFactory extends Factory
{
    protected $model = LaboratoryRoom::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'lab_type' => fake()->randomElement(['patologi_klinik', 'mikrobiologi', 'patologi_anatomi']),
            'is_active' => true,
        ];
    }
}
