<?php

namespace Modules\LayananAntimicrobialStewardshipPriorHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipPriorHistory\Models\AntimicrobialStewardshipPriorHistory;
use Tests\TestCase;

class AntimicrobialStewardshipPriorHistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_historys(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipPriorHistory::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-prior-histories')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_history(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-prior-histories', [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory()->create()->id,
            'previous_antibiotic' => 'Test Previous_antibiotic',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_prior_histories', 1);
    }

}
