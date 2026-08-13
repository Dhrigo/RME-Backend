<?php

namespace Modules\PendaftaranServiceHandover\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranServiceHandover\Models\ServiceHandover;
use Modules\PendaftaranVisit\Models\Visit;

class ServiceHandoverFactory extends Factory
{
    protected $model = ServiceHandover::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'ward_id' => Ward::factory(),
            'handed_over_by' => null,
            'received_by' => null,
            'handed_over_at' => now(),
            'received_at' => null,
            'notes' => null,
            'status' => 'pending',
        ];
    }
}
