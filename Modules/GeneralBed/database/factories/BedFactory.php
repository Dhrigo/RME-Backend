<?php

namespace Modules\GeneralBed\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralRoom\Models\Room;

class BedFactory extends Factory
{
    protected $model = Bed::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'bed_number' => fake()->unique()->bothify('B-##'),
            'is_active' => true,
        ];
    }
}
