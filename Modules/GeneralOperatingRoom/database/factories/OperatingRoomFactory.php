<?php

namespace Modules\GeneralOperatingRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralOperatingRoom\Models\OperatingRoom;
use Modules\GeneralWard\Models\Ward;

class OperatingRoomFactory extends Factory
{
    protected $model = OperatingRoom::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'room_number' => fake()->unique()->bothify('OK-##'),
            'equipment_notes' => fake()->optional()->sentence(),
            'is_active' => true,
        ];
    }
}
