<?php

namespace Modules\BerkasKlaimRadiologyClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;
use Modules\LayananLabOrder\Models\LabOrder;
use Tests\TestCase;

class RadiologyClaimControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/radiology-claims', [
            'claim_file_id' => $claimFile->id,
            'order_id' => $order->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
        $this->assertDatabaseHas('radiology_claims', ['claim_file_id' => $claimFile->id, 'order_id' => $order->id]);
    }

    public function test_it_lists_claims_filtered_by_claim_file(): void
    {
        $this->actingUser();
        $claimFile = ClaimFile::factory()->create();
        RadiologyClaim::factory()->create(['claim_file_id' => $claimFile->id]);
        RadiologyClaim::factory()->create();

        $response = $this->getJson("/api/v1/radiology-claims?claim_file_id={$claimFile->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_submits_a_draft_claim(): void
    {
        $this->actingUser();
        $claim = RadiologyClaim::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/radiology-claims/{$claim->id}", ['status' => 'submitted'])
            ->assertOk()
            ->assertJsonPath('data.status', 'submitted');
    }

    public function test_it_rejects_updating_an_approved_claim(): void
    {
        $this->actingUser();
        $claim = RadiologyClaim::factory()->create(['status' => 'approved']);

        $this->putJson("/api/v1/radiology-claims/{$claim->id}", ['status' => 'submitted'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_radiology_claims(): void
    {
        $this->getJson('/api/v1/radiology-claims')->assertStatus(401);
    }
}
