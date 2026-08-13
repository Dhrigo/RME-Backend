<?php

namespace Modules\GeneralRoomClassReferenceGroup\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralRoomClassReferenceGroup\Models\RoomClassReferenceGroup;

class RoomClassReferenceGroupFactory extends Factory
{
    protected $model = RoomClassReferenceGroup::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
