<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPharmacyGuarantorMargin\Models\PharmacyGuarantorMargin;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class PharmacyGuarantorMarginFactory extends Factory
{
    protected $model = PharmacyGuarantorMargin::class;

    public function definition(): array
    {
        return [
            'guarantor_id' => Guarantor::factory(),
            'margin_percentage' => fake()->randomFloat(2, 1, 25),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
