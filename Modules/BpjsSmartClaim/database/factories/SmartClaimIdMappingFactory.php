<?php

namespace Modules\BpjsSmartClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsSmartClaim\Models\SmartClaimIdMapping;

class SmartClaimIdMappingFactory extends Factory
{
    protected $model = SmartClaimIdMapping::class;

    public function definition(): array
    {
        return [
            'ref_id' => fake()->numberBetween(1, 100000),
            'ref_type' => 'patient',
            'type_code' => null,
        ];
    }
}
