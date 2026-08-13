<?php

namespace Modules\GeneralWardClassAssignment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralRoomClass\Models\RoomClass;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardClassAssignment\Models\WardClassAssignment;

class WardClassAssignmentFactory extends Factory
{
    protected $model = WardClassAssignment::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'room_class_id' => RoomClass::factory(),
        ];
    }
}
