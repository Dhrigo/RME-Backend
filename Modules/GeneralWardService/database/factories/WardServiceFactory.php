<?php

namespace Modules\GeneralWardService\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWardService\Models\WardService;

class WardServiceFactory extends Factory
{
    protected $model = WardService::class;

    public function definition(): array
    {
        return [
            'ward_id' => \Modules\GeneralWard\Models\Ward::factory(),
            'service_id' => \Modules\GeneralService\Models\Service::factory(),
            'is_active' => true,
        ];
    }
}
