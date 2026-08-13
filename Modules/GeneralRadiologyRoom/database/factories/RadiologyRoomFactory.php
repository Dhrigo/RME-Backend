<?php

namespace Modules\GeneralRadiologyRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralRadiologyRoom\Models\RadiologyRoom;
use Modules\GeneralWard\Models\Ward;

class RadiologyRoomFactory extends Factory
{
    protected $model = RadiologyRoom::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'radiology_type' => fake()->randomElement(['rontgen', 'ct_scan', 'mri', 'usg']),
            'is_active' => true,
        ];
    }
}
