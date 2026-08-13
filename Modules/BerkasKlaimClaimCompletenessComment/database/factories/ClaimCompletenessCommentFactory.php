<?php

namespace Modules\BerkasKlaimClaimCompletenessComment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimCompletenessComment\Models\ClaimCompletenessComment;
use Modules\BerkasKlaimClaimCompleteness\Models\ClaimCompleteness;

class ClaimCompletenessCommentFactory extends Factory
{
    protected $model = ClaimCompletenessComment::class;

    public function definition(): array
    {
        return [
            'claim_completeness_id' => ClaimCompleteness::factory(),
            'comment' => $this->faker->paragraph(),
            'commented_by' => $this->faker->name(),
            'commented_at' => $this->faker->dateTime(),
        ];
    }
}
