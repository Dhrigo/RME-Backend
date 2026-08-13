<?php

namespace Modules\GeneralDoctorWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\GeneralDoctorWardAssignment\Models\DoctorWardAssignment;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralWard\Models\Ward;

class DoctorWardAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_assignments()
    {
        DoctorWardAssignment::factory()->count(3)->create();
        $response = $this->getJson('/api/doctor-ward-assignments');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_assignment()
    {
        $doctor = Doctor::factory()->create();
        $ward = Ward::factory()->create();
        $data = [
            'doctor_id' => $doctor->id,
            'ward_id' => $ward->id,
            'assigned_at' => now()->format('Y-m-d H:i:s'),
            'schedule_day' => 'Monday',
        ];
        $response = $this->postJson('/api/doctor-ward-assignments', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('doctor_ward_assignments', $data);
    }

    public function test_can_show_assignment()
    {
        $assignment = DoctorWardAssignment::factory()->create();
        $response = $this->getJson("/api/doctor-ward-assignments/{$assignment->id}");
        $response->assertOk()->assertJsonPath('data.id', $assignment->id);
    }

    public function test_can_update_assignment()
    {
        $assignment = DoctorWardAssignment::factory()->create(['schedule_day' => 'Monday']);
        $response = $this->putJson("/api/doctor-ward-assignments/{$assignment->id}", [
            'schedule_day' => 'Tuesday',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('doctor_ward_assignments', [
            'id' => $assignment->id,
            'schedule_day' => 'Tuesday',
        ]);
    }

    public function test_can_delete_assignment()
    {
        $assignment = DoctorWardAssignment::factory()->create();
        $response = $this->deleteJson("/api/doctor-ward-assignments/{$assignment->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('doctor_ward_assignments', ['id' => $assignment->id]);
    }
}
