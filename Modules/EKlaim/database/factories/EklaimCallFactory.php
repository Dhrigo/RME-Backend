<?php

namespace Modules\EKlaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\EKlaim\Models\EklaimCall;

class EklaimCallFactory extends Factory
{
    protected $model = EklaimCall::class;

    public function definition(): array
    {
        return [
            'method' => 'get_claim_status',
            'request_data' => ['nomor_sep' => fake()->numerify('##################')],
            'status' => 'pending',
        ];
    }
}
