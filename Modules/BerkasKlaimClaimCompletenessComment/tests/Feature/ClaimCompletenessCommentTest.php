<?php

namespace Modules\BerkasKlaimClaimCompletenessComment\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BerkasKlaimClaimCompletenessComment\Models\ClaimCompletenessComment;
use Modules\BerkasKlaimClaimCompleteness\Models\ClaimCompleteness;
use Modules\Auth\Models\User;

class ClaimCompletenessCommentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_can_list_comments()
    {
        ClaimCompletenessComment::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/claim-completeness-comments');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_comment()
    {
        $comp = ClaimCompleteness::factory()->create();

        $response = $this->postJson('/api/v1/claim-completeness-comments', [
            'claim_completeness_id' => $comp->id,
            'comment' => 'Komentar baru'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('claim_completeness_comments', ['claim_completeness_id' => $comp->id]);
    }

    public function test_can_update_comment()
    {
        $doc = ClaimCompletenessComment::factory()->create(['comment' => 'Old']);

        $response = $this->putJson("/api/v1/claim-completeness-comments/{$doc->id}", [
            'comment' => 'New'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('New', $doc->fresh()->comment);
    }

    public function test_can_delete_comment()
    {
        $doc = ClaimCompletenessComment::factory()->create();

        $response = $this->deleteJson("/api/v1/claim-completeness-comments/{$doc->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('claim_completeness_comments', ['id' => $doc->id]);
    }
}
