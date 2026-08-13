<?php

namespace Modules\GeneralWardTransferRoute\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWardTransferRoute\Models\WardTransferRoute;

class WardTransferRouteFactory extends Factory
{
    protected $model = WardTransferRoute::class;

    public function definition(): array
    {
        return [
            'from_ward_id' => \Modules\GeneralWard\Models\Ward::factory(),
            'to_ward_id' => \Modules\GeneralWard\Models\Ward::factory(),
            'requires_approval' => false,
            'is_active' => true,
        ];
    }
}
