<?php

namespace Modules\BerkasKlaimClaimCompleteness\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimCompleteness\Models\ClaimCompleteness;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;

class ClaimCompletenessFactory extends Factory
{
    protected $model = ClaimCompleteness::class;

    public function definition(): array
    {
        return [
            'claim_file_id' => ClaimFile::factory(),
            'checklist_item' => $this->faker->sentence(),
            'is_complete' => $this->faker->boolean(),
            'checked_by' => $this->faker->name(),
            'checked_at' => $this->faker->dateTime(),
        ];
    }
}
