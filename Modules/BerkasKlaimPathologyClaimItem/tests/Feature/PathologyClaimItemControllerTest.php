<?php

namespace Modules\BerkasKlaimPathologyClaimItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;
use Modules\BerkasKlaimPathologyClaimItem\Models\PathologyClaimItem;
use Tests\TestCase;

class PathologyClaimItemControllerTest extends TestCase
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
        $claim = PathologyClaim::factory()->create();

        $response = $this->postJson('/api/v1/pathology-claim-items', [
            'pathology_claim_id' => $claim->id,
            'exam_name' => 'Pemeriksaan Histopatologi',
            'amount' => 350000,
        ]);

        $response->assertCreated()->assertJsonPath('data.exam_name', 'Pemeriksaan Histopatologi');
        $this->assertDatabaseHas('pathology_claim_items', ['pathology_claim_id' => $claim->id, 'exam_name' => 'Pemeriksaan Histopatologi']);
    }

    public function test_it_lists_items_filtered_by_claim(): void
    {
        $this->actingUser();
        $claim = PathologyClaim::factory()->create();
        PathologyClaimItem::factory()->create(['pathology_claim_id' => $claim->id]);
        PathologyClaimItem::factory()->create();

        $response = $this->getJson("/api/v1/pathology-claim-items?pathology_claim_id={$claim->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_shows_a_claim_item(): void
    {
        $this->actingUser();
        $item = PathologyClaimItem::factory()->create();

        $this->getJson("/api/v1/pathology-claim-items/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_store_requires_claim_and_exam_name(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pathology-claim-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['pathology_claim_id', 'exam_name', 'amount']);
    }

    public function test_guest_cannot_access_claim_items(): void
    {
        $this->getJson('/api/v1/pathology-claim-items')->assertStatus(401);
    }
}
