<?php

namespace Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Models\AntimicrobialStewardshipMicrobiologyResult;
use Tests\TestCase;

class AntimicrobialStewardshipMicrobiologyResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_micros(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipMicrobiologyResult::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-microbiology-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_micro(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-microbiology-results', [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory()->create()->id,
            'specimen_type' => 'Test Specimen_type',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_microbiology_results', 1);
    }

}
