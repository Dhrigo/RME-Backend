<?php

namespace Modules\BerkasKlaimClinicalLabClaimItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;
use Modules\BerkasKlaimClinicalLabClaimItem\Models\ClinicalLabClaimItem;
use Tests\TestCase;

class ClinicalLabClaimItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_claim_item(): void
    {
        $this->actingUser();
        $claim = ClinicalLabClaim::factory()->create();

        $response = $this->postJson('/api/v1/clinical-lab-claim-items', [
            'clinical_lab_claim_id' => $claim->id,
            'test_name' => 'Darah Lengkap',
            'amount' => 150000,
        ]);

        $response->assertCreated()->assertJsonPath('data.test_name', 'Darah Lengkap');
        $this->assertDatabaseHas('clinical_lab_claim_items', ['clinical_lab_claim_id' => $claim->id, 'test_name' => 'Darah Lengkap']);
    }

    public function test_it_lists_items_filtered_by_claim(): void
    {
        $this->actingUser();
        $claim = ClinicalLabClaim::factory()->create();
        ClinicalLabClaimItem::factory()->create(['clinical_lab_claim_id' => $claim->id]);
        ClinicalLabClaimItem::factory()->create();

        $response = $this->getJson("/api/v1/clinical-lab-claim-items?clinical_lab_claim_id={$claim->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_shows_a_claim_item(): void
    {
        $this->actingUser();
        $item = ClinicalLabClaimItem::factory()->create();

        $this->getJson("/api/v1/clinical-lab-claim-items/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_store_requires_claim_and_test_name(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/clinical-lab-claim-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['clinical_lab_claim_id', 'test_name', 'amount']);
    }

    public function test_guest_cannot_access_claim_items(): void
    {
        $this->getJson('/api/v1/clinical-lab-claim-items')->assertStatus(401);
    }
}
