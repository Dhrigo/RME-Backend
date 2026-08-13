<?php

namespace Modules\MedicalRecordEndOfLifePsychosocialRelationship\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Models\EndOfLifePsychosocialRelationship;
use Tests\TestCase;

class EndOfLifePsychosocialRelationshipControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $visitId = Visit::factory()->create();
        $assessedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/eol-psychosocial-relationships', [
            'visit_id' => $visitId->id,
            'assessed_by' => $assessedBy->id,
            'assessed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('end_of_life_psychosocial_relationships', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        EndOfLifePsychosocialRelationship::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/eol-psychosocial-relationships');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = EndOfLifePsychosocialRelationship::factory()->create();

        $this->getJson("/api/v1/eol-psychosocial-relationships/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = EndOfLifePsychosocialRelationship::factory()->create();

        $this->deleteJson("/api/v1/eol-psychosocial-relationships/{$record->id}")->assertStatus(204);
    }
}
