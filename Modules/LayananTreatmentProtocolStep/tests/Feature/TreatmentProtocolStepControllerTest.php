<?php

namespace Modules\LayananTreatmentProtocolStep\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;
use Tests\TestCase;

class TreatmentProtocolStepControllerTest extends TestCase
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
        $treatmentProtocolId = TreatmentProtocol::factory()->create();

        $response = $this->postJson('/api/v1/treatment-protocol-steps', [
            'treatment_protocol_id' => $treatmentProtocolId->id,
            'sequence' => 3,
            'instruction' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('treatment_protocol_steps', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TreatmentProtocolStep::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/treatment-protocol-steps');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = TreatmentProtocolStep::factory()->create();

        $this->getJson("/api/v1/treatment-protocol-steps/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = TreatmentProtocolStep::factory()->create();

        $this->deleteJson("/api/v1/treatment-protocol-steps/{$record->id}")->assertStatus(204);
    }
}
