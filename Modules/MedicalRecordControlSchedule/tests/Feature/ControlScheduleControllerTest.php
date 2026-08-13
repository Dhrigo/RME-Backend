<?php

namespace Modules\MedicalRecordControlSchedule\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordControlSchedule\Models\ControlSchedule;
use Tests\TestCase;

class ControlScheduleControllerTest extends TestCase
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
        $patientId = Patient::factory()->create();
        $scheduledBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/control-schedules', [
            'patient_id' => $patientId->id,
            'scheduled_date' => now()->toDateTimeString(),
            'scheduled_by' => $scheduledBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('control_schedules', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ControlSchedule::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/control-schedules');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ControlSchedule::factory()->create();

        $this->getJson("/api/v1/control-schedules/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ControlSchedule::factory()->create();

        $this->deleteJson("/api/v1/control-schedules/{$record->id}")->assertStatus(204);
    }
}
