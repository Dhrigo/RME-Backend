<?php

namespace Modules\GeneralGuarantorWardAccess\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralGuarantorWardAccess\Models\GuarantorWardAccess;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorWardAccessFactory extends Factory
{
    protected $model = GuarantorWardAccess::class;

    public function definition(): array
    {
        return [
            'guarantor_id' => Guarantor::factory(),
            'ward_id' => Ward::factory(),
            'is_allowed' => true,
            'notes' => null,
        ];
    }
}
