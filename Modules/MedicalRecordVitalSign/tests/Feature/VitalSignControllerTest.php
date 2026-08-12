<?php

namespace Modules\MedicalRecordVitalSign\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordVitalSign\Models\VitalSign;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class VitalSignControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_vital_sign_reading(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/vital-signs', [
            'visit_id' => $visit->id,
            'recorded_by' => $recordedBy->id,
            'temperature' => 38.5,
            'pulse' => 88,
            'systolic' => 120,
            'diastolic' => 80,
        ]);

        $response->assertCreated()->assertJsonPath('data.pulse', 88);
        $this->assertDatabaseHas('vital_signs', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_readings_filtered_by_visit_ordered_latest_first(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $older = VitalSign::factory()->create(['visit_id' => $visit->id, 'recorded_at' => now()->subHour()]);
        $newer = VitalSign::factory()->create(['visit_id' => $visit->id, 'recorded_at' => now()]);
        VitalSign::factory()->create();

        $response = $this->getJson("/api/v1/vital-signs?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
        $this->assertEquals($newer->id, $response->json('data.0.id'));
    }

    public function test_guest_cannot_access_vital_signs(): void
    {
        $this->getJson('/api/v1/vital-signs')->assertStatus(401);
    }
}
