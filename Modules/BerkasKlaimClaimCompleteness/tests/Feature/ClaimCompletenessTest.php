<?php

namespace Modules\BerkasKlaimClaimCompleteness\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BerkasKlaimClaimCompleteness\Models\ClaimCompleteness;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\Auth\Models\User;

class ClaimCompletenessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_can_list_claim_completeness()
    {
        ClaimCompleteness::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/claim-completeness');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_claim_completeness()
    {
        $file = ClaimFile::factory()->create();

        $response = $this->postJson('/api/v1/claim-completeness', [
            'claim_file_id' => $file->id,
            'checklist_item' => 'Surat Rujukan',
            'is_complete' => true
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('claim_completeness', ['claim_file_id' => $file->id]);
    }

    public function test_can_update_claim_completeness()
    {
        $doc = ClaimCompleteness::factory()->create(['checklist_item' => 'Old']);

        $response = $this->putJson("/api/v1/claim-completeness/{$doc->id}", [
            'checklist_item' => 'New'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('New', $doc->fresh()->checklist_item);
    }

    public function test_can_delete_claim_completeness()
    {
        $doc = ClaimCompleteness::factory()->create();

        $response = $this->deleteJson("/api/v1/claim-completeness/{$doc->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('claim_completeness', ['id' => $doc->id]);
    }
}
