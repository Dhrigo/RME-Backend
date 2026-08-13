<?php

namespace Modules\BerkasKlaimClinicalLabClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;
use Modules\LayananLabOrder\Models\LabOrder;
use Tests\TestCase;

class ClinicalLabClaimControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_draft_claim(): void
    {
        $this->actingUser();
        $claimFile = ClaimFile::factory()->create();
        $order = LabOrder::factory()->create();

        $response = $this->postJson('/api/v1/clinical-lab-claims', [
            'claim_file_id' => $claimFile->id,
            'order_id' => $order->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
        $this->assertDatabaseHas('clinical_lab_claims', ['claim_file_id' => $claimFile->id, 'order_id' => $order->id]);
    }

    public function test_it_lists_claims_filtered_by_claim_file(): void
    {
        $this->actingUser();
        $claimFile = ClaimFile::factory()->create();
        ClinicalLabClaim::factory()->create(['claim_file_id' => $claimFile->id]);
        ClinicalLabClaim::factory()->create();

        $response = $this->getJson("/api/v1/clinical-lab-claims?claim_file_id={$claimFile->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_submits_a_draft_claim(): void
    {
        $this->actingUser();
        $claim = ClinicalLabClaim::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/clinical-lab-claims/{$claim->id}", ['status' => 'submitted'])
            ->assertOk()
            ->assertJsonPath('data.status', 'submitted');
    }

    public function test_it_rejects_updating_an_approved_claim(): void
    {
        $this->actingUser();
        $claim = ClinicalLabClaim::factory()->create(['status' => 'approved']);

        $this->putJson("/api/v1/clinical-lab-claims/{$claim->id}", ['status' => 'submitted'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_clinical_lab_claims(): void
    {
        $this->getJson('/api/v1/clinical-lab-claims')->assertStatus(401);
    }
}
