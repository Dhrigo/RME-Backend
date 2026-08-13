<?php

namespace Modules\BerkasKlaimPharmacyClaimItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;
use Modules\BerkasKlaimPharmacyClaimItem\Models\PharmacyClaimItem;

class PharmacyClaimItemFactory extends Factory
{
    protected $model = PharmacyClaimItem::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 30);
        $unitPrice = fake()->randomFloat(2, 2000, 250000);

        return [
            'pharmacy_claim_id' => PharmacyClaim::factory(),
            'drug_name' => fake()->randomElement(['Paracetamol 500mg', 'Amoxicillin 500mg', 'Cefixime 100mg', 'Omeprazole 20mg', 'Ceftriaxone Injeksi 1g']),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'amount' => round($quantity * $unitPrice, 2),
        ];
    }
}
