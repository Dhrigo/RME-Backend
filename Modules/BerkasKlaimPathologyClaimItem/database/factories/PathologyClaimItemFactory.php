<?php

namespace Modules\BerkasKlaimPathologyClaimItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;
use Modules\BerkasKlaimPathologyClaimItem\Models\PathologyClaimItem;

class PathologyClaimItemFactory extends Factory
{
    protected $model = PathologyClaimItem::class;

    public function definition(): array
    {
        return [
            'pathology_claim_id' => PathologyClaim::factory(),
            'exam_name' => fake()->randomElement(['Pemeriksaan Histopatologi', 'Pemeriksaan Sitologi', 'Pemeriksaan Imunohistokimia', 'Frozen Section', 'Fine Needle Aspiration Biopsy']),
            'amount' => fake()->randomFloat(2, 75000, 1500000),
        ];
    }
}
