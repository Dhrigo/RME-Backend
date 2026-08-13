<?php

namespace Modules\BerkasKlaimRadiologyClaimItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;
use Modules\BerkasKlaimRadiologyClaimItem\Models\RadiologyClaimItem;

class RadiologyClaimItemFactory extends Factory
{
    protected $model = RadiologyClaimItem::class;

    public function definition(): array
    {
        return [
            'radiology_claim_id' => RadiologyClaim::factory(),
            'exam_name' => fake()->randomElement(['Rontgen Thorax', 'CT Scan Kepala', 'USG Abdomen', 'MRI Lumbal', 'Mammografi']),
            'amount' => fake()->randomFloat(2, 50000, 2000000),
        ];
    }
}
