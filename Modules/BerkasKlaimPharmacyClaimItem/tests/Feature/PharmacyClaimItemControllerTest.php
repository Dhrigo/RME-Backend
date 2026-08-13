<?php

namespace Modules\BerkasKlaimPharmacyClaimItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;
use Modules\BerkasKlaimPharmacyClaimItem\Models\PharmacyClaimItem;
use Tests\TestCase;

class PharmacyClaimItemControllerTest extends TestCase
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
        $claim = PharmacyClaim::factory()->create();

        $response = $this->postJson('/api/v1/pharmacy-claim-items', [
            'pharmacy_claim_id' => $claim->id,
            'drug_name' => 'Amoxicillin 500mg',
            'quantity' => 10,
            'unit_price' => 5000,
            'amount' => 50000,
        ]);

        $response->assertCreated()->assertJsonPath('data.drug_name', 'Amoxicillin 500mg');
        $this->assertDatabaseHas('pharmacy_claim_items', ['pharmacy_claim_id' => $claim->id, 'drug_name' => 'Amoxicillin 500mg']);
    }

    public function test_it_lists_items_filtered_by_claim(): void
    {
        $this->actingUser();
        $claim = PharmacyClaim::factory()->create();
        PharmacyClaimItem::factory()->create(['pharmacy_claim_id' => $claim->id]);
        PharmacyClaimItem::factory()->create();

        $response = $this->getJson("/api/v1/pharmacy-claim-items?pharmacy_claim_id={$claim->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_shows_a_claim_item(): void
    {
        $this->actingUser();
        $item = PharmacyClaimItem::factory()->create();

        $this->getJson("/api/v1/pharmacy-claim-items/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_store_requires_claim_and_drug_name(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pharmacy-claim-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['pharmacy_claim_id', 'drug_name', 'quantity', 'unit_price', 'amount']);
    }

    public function test_guest_cannot_access_claim_items(): void
    {
        $this->getJson('/api/v1/pharmacy-claim-items')->assertStatus(401);
    }
}
