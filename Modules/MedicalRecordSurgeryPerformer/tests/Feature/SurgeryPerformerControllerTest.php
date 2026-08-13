<?php

namespace Modules\MedicalRecordSurgeryPerformer\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordSurgeryPerformer\Models\SurgeryPerformer;
use Tests\TestCase;

class SurgeryPerformerControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_surgery_performer_record(): void
    {
        $this->actingUser();

        $payload = [
            'surgery_id' => 12,
            'visit_id' => 4,
            'doctor_id' => 8,
            'role' => 'Lead Surgeon',
        ];

        $response = $this->postJson('/api/v1/surgery-performers', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.role', 'Lead Surgeon');

        $this->assertDatabaseHas('surgery_performers', ['surgery_id' => 12, 'doctor_id' => 8]);
    }

    public function test_it_lists_surgery_performers(): void
    {
        $this->actingUser();
        SurgeryPerformer::factory()->count(2)->create(['surgery_id' => 12]);

        $response = $this->getJson('/api/v1/surgery-performers?surgery_id=12');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_surgery_performer(): void
    {
        $this->actingUser();
        $record = SurgeryPerformer::factory()->create();

        $response = $this->getJson("/api/v1/surgery-performers/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_surgery_performer(): void
    {
        $this->actingUser();
        $record = SurgeryPerformer::factory()->create();

        $response = $this->putJson("/api/v1/surgery-performers/{$record->id}", [
            'role' => 'Assistant Surgeon',
        ]);

        $response->assertOk()->assertJsonPath('data.role', 'Assistant Surgeon');
    }

    public function test_it_deletes_a_surgery_performer(): void
    {
        $this->actingUser();
        $record = SurgeryPerformer::factory()->create();

        $response = $this->deleteJson("/api/v1/surgery-performers/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('surgery_performers', ['id' => $record->id]);
    }
}
