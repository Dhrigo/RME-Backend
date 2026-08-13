<?php

namespace Modules\MedicalRecordAnamnesisSource\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;
use Modules\MedicalRecordAnamnesisSource\Models\AnamnesisSource;
use Tests\TestCase;

class AnamnesisSourceControllerTest extends TestCase
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
        $anamnesisId = Anamnesis::factory()->create();

        $response = $this->postJson('/api/v1/anamnesis-sources', [
            'anamnesis_id' => $anamnesisId->id,
            'source_type' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('anamnesis_sources', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        AnamnesisSource::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/anamnesis-sources');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = AnamnesisSource::factory()->create();

        $this->getJson("/api/v1/anamnesis-sources/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = AnamnesisSource::factory()->create();

        $this->deleteJson("/api/v1/anamnesis-sources/{$record->id}")->assertStatus(204);
    }
}
