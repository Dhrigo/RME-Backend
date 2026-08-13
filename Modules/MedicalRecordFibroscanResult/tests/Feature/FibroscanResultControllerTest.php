<?php

namespace Modules\MedicalRecordFibroscanResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFibroscanResult\Models\FibroscanResult;
use Tests\TestCase;

class FibroscanResultControllerTest extends TestCase
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
        $examinedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/fibroscan-results', [
            'visit_id' => $visitId->id,
            'examination_date' => now()->toDateTimeString(),
            'examined_by' => $examinedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('fibroscan_results', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        FibroscanResult::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/fibroscan-results');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = FibroscanResult::factory()->create();

        $this->getJson("/api/v1/fibroscan-results/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = FibroscanResult::factory()->create();

        $this->deleteJson("/api/v1/fibroscan-results/{$record->id}")->assertStatus(204);
    }
}
