<?php

namespace Modules\BerkasKlaimRadiologyClaimItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;
use Modules\BerkasKlaimRadiologyClaimItem\Models\RadiologyClaimItem;
use Tests\TestCase;

class RadiologyClaimItemControllerTest extends TestCase
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
        $claim = RadiologyClaim::factory()->create();

        $response = $this->postJson('/api/v1/radiology-claim-items', [
            'radiology_claim_id' => $claim->id,
            'exam_name' => 'Rontgen Thorax',
            'amount' => 250000,
        ]);

        $response->assertCreated()->assertJsonPath('data.exam_name', 'Rontgen Thorax');
        $this->assertDatabaseHas('radiology_claim_items', ['radiology_claim_id' => $claim->id, 'exam_name' => 'Rontgen Thorax']);
    }

    public function test_it_lists_items_filtered_by_claim(): void
    {
        $this->actingUser();
        $claim = RadiologyClaim::factory()->create();
        RadiologyClaimItem::factory()->create(['radiology_claim_id' => $claim->id]);
        RadiologyClaimItem::factory()->create();

        $response = $this->getJson("/api/v1/radiology-claim-items?radiology_claim_id={$claim->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_shows_a_claim_item(): void
    {
        $this->actingUser();
        $item = RadiologyClaimItem::factory()->create();

        $this->getJson("/api/v1/radiology-claim-items/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_store_requires_claim_and_exam_name(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/radiology-claim-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['radiology_claim_id', 'exam_name', 'amount']);
    }

    public function test_guest_cannot_access_claim_items(): void
    {
        $this->getJson('/api/v1/radiology-claim-items')->assertStatus(401);
    }
}
