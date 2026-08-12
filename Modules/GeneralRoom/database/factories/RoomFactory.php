<?php

namespace Modules\GeneralRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralRoom\Models\Room;
use Modules\GeneralWard\Models\Ward;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'room_number' => fake()->unique()->bothify('R-###'),
            'class_id' => null,
            'is_active' => true,
        ];
    }
}
