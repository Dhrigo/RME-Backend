<?php

namespace Modules\LayananTreatmentProtocolStepDrug\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;
use Modules\LayananTreatmentProtocolStepDrug\Models\TreatmentProtocolStepDrug;
use Tests\TestCase;

class TreatmentProtocolStepDrugControllerTest extends TestCase
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
        $treatmentProtocolStepId = TreatmentProtocolStep::factory()->create();

        $response = $this->postJson('/api/v1/treatment-protocol-step-drugs', [
            'treatment_protocol_step_id' => $treatmentProtocolStepId->id,
            'drug_name' => 'Test value',
            'dosage' => 'Test value',
            'frequency' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('treatment_protocol_step_drugs', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TreatmentProtocolStepDrug::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/treatment-protocol-step-drugs');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = TreatmentProtocolStepDrug::factory()->create();

        $this->getJson("/api/v1/treatment-protocol-step-drugs/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = TreatmentProtocolStepDrug::factory()->create();

        $this->deleteJson("/api/v1/treatment-protocol-step-drugs/{$record->id}")->assertStatus(204);
    }
}
