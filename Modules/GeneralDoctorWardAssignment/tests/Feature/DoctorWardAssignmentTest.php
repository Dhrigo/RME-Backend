<?php

namespace Modules\GeneralDoctorWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Auth\Models\User;
use Modules\GeneralDoctorWardAssignment\Models\DoctorWardAssignment;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralWard\Models\Ward;

class DoctorWardAssignmentTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_can_list_assignments()
    {
        $this->actingUser();
        DoctorWardAssignment::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/doctor-ward-assignments');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_filter_by_ward()
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        DoctorWardAssignment::factory()->create(['ward_id' => $ward->id]);
        DoctorWardAssignment::factory()->create();
        $response = $this->getJson("/api/v1/doctor-ward-assignments?ward_id={$ward->id}");
        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_can_create_assignment()
    {
        $this->actingUser();
        $doctor = Doctor::factory()->create();
        $ward = Ward::factory()->create();
        $data = [
            'doctor_id' => $doctor->id,
            'ward_id' => $ward->id,
            'assigned_at' => now()->format('Y-m-d H:i:s'),
            'schedule_day' => 'Monday',
        ];
        $response = $this->postJson('/api/v1/doctor-ward-assignments', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('doctor_ward_assignments', $data);
    }

    public function test_can_show_assignment()
    {
        $this->actingUser();
        $assignment = DoctorWardAssignment::factory()->create();
        $response = $this->getJson("/api/v1/doctor-ward-assignments/{$assignment->id}");
        $response->assertOk()->assertJsonPath('data.id', $assignment->id);
    }

    public function test_can_update_assignment()
    {
        $this->actingUser();
        $assignment = DoctorWardAssignment::factory()->create(['schedule_day' => 'Monday']);
        $response = $this->putJson("/api/v1/doctor-ward-assignments/{$assignment->id}", [
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
        $this->actingUser();
        $assignment = DoctorWardAssignment::factory()->create();
        $response = $this->deleteJson("/api/v1/doctor-ward-assignments/{$assignment->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('doctor_ward_assignments', ['id' => $assignment->id]);
    }

    public function test_guest_cannot_access_doctor_ward_assignments(): void
    {
        $this->getJson('/api/v1/doctor-ward-assignments')->assertStatus(401);
    }
}
