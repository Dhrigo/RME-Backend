<?php

namespace Modules\LayananAntimicrobialStewardshipApproval\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipApproval\Models\AntimicrobialStewardshipApproval;
use Tests\TestCase;

class AntimicrobialStewardshipApprovalControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_approvals(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipApproval::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-approvals')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_approval(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-approvals', [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory()->create()->id,
            'decision' => 'approved',
            'decided_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_approvals', 1);
    }

}
