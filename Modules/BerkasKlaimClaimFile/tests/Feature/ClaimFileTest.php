<?php

namespace Modules\BerkasKlaimClaimFile\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\Auth\Models\User;

class ClaimFileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_can_list_claim_files()
    {
        ClaimFile::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/claim-files');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_claim_file()
    {
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/claim-files', [
            'visit_id' => $visit->id,
            'status' => 'draft'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('claim_files', ['visit_id' => $visit->id]);
    }

    public function test_can_update_claim_file()
    {
        $file = ClaimFile::factory()->create(['status' => 'draft']);

        $response = $this->putJson("/api/v1/claim-files/{$file->id}", [
            'status' => 'submitted'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('submitted', $file->fresh()->status);
    }

    public function test_can_delete_claim_file()
    {
        $file = ClaimFile::factory()->create();

        $response = $this->deleteJson("/api/v1/claim-files/{$file->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('claim_files', ['id' => $file->id]);
    }
}
