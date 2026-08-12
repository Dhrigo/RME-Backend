<?php

namespace Modules\MedicalRecordTriage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordTriage\Models\Triage;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class TriageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_triage_assessment(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $assessedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/triages', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'level' => 2,
            'chief_complaint' => 'Nyeri dada',
        ]);

        $response->assertCreated()->assertJsonPath('data.level', 2);
        $this->assertDatabaseHas('triages', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_rejects_invalid_level(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $assessedBy = Employee::factory()->create();

        $this->postJson('/api/v1/triages', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'level' => 6,
        ])->assertStatus(422);
    }

    public function test_it_lists_triages_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        Triage::factory()->count(2)->create(['visit_id' => $visit->id]);
        Triage::factory()->create();

        $response = $this->getJson("/api/v1/triages?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_guest_cannot_access_triages(): void
    {
        $this->getJson('/api/v1/triages')->assertStatus(401);
    }
}
