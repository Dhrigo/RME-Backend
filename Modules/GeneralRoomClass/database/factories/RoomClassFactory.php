<?php

namespace Modules\GeneralRoomClass\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralRoomClass\Models\RoomClass;

class RoomClassFactory extends Factory
{
    protected $model = RoomClass::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
