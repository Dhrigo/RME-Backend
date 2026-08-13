<?php

namespace Modules\BerkasKlaimClinicalLabClaimItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;
use Modules\BerkasKlaimClinicalLabClaimItem\Models\ClinicalLabClaimItem;

class ClinicalLabClaimItemFactory extends Factory
{
    protected $model = ClinicalLabClaimItem::class;

    public function definition(): array
    {
        return [
            'clinical_lab_claim_id' => ClinicalLabClaim::factory(),
            'test_name' => fake()->randomElement(['Darah Lengkap', 'Gula Darah Puasa', 'Kolesterol Total', 'Fungsi Hati', 'Fungsi Ginjal', 'Urinalisis']),
            'amount' => fake()->randomFloat(2, 25000, 750000),
        ];
    }
}
