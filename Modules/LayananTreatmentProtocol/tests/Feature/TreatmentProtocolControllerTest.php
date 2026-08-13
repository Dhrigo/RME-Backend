<?php

namespace Modules\LayananTreatmentProtocol\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;
use Tests\TestCase;

class TreatmentProtocolControllerTest extends TestCase
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
        $prescribedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/treatment-protocols', [
            'visit_id' => $visitId->id,
            'protocol_name' => 'Test value',
            'prescribed_by' => $prescribedBy->id,
            'started_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('treatment_protocols', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TreatmentProtocol::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/treatment-protocols');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = TreatmentProtocol::factory()->create();

        $this->getJson("/api/v1/treatment-protocols/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = TreatmentProtocol::factory()->create();

        $this->deleteJson("/api/v1/treatment-protocols/{$record->id}")->assertStatus(204);
    }
}
