<?php

namespace Modules\GeneralStaffWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Auth\Models\User;
use Modules\GeneralStaffWardAssignment\Models\StaffWardAssignment;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralWard\Models\Ward;

class StaffWardAssignmentTest extends TestCase
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
        StaffWardAssignment::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/staff-ward-assignments');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_filter_by_ward()
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        StaffWardAssignment::factory()->create(['ward_id' => $ward->id]);
        StaffWardAssignment::factory()->create();
        $response = $this->getJson("/api/v1/staff-ward-assignments?ward_id={$ward->id}");
        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_can_create_assignment()
    {
        $this->actingUser();
        $staffMember = StaffMember::factory()->create();
        $ward = Ward::factory()->create();
        $data = [
            'staff_member_id' => $staffMember->id,
            'ward_id' => $ward->id,
            'assigned_at' => now()->format('Y-m-d H:i:s'),
        ];
        $response = $this->postJson('/api/v1/staff-ward-assignments', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('staff_ward_assignments', $data);
    }

    public function test_can_show_assignment()
    {
        $this->actingUser();
        $assignment = StaffWardAssignment::factory()->create();
        $response = $this->getJson("/api/v1/staff-ward-assignments/{$assignment->id}");
        $response->assertOk()->assertJsonPath('data.id', $assignment->id);
    }

    public function test_can_update_assignment()
    {
        $this->actingUser();
        $assignment = StaffWardAssignment::factory()->create(['assigned_at' => '2026-08-13 10:00:00']);
        $response = $this->putJson("/api/v1/staff-ward-assignments/{$assignment->id}", [
            'assigned_at' => '2026-08-13 12:00:00',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('staff_ward_assignments', [
            'id' => $assignment->id,
            'assigned_at' => '2026-08-13 12:00:00',
        ]);
    }

    public function test_can_delete_assignment()
    {
        $this->actingUser();
        $assignment = StaffWardAssignment::factory()->create();
        $response = $this->deleteJson("/api/v1/staff-ward-assignments/{$assignment->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('staff_ward_assignments', ['id' => $assignment->id]);
    }

    public function test_guest_cannot_access_staff_ward_assignments(): void
    {
        $this->getJson('/api/v1/staff-ward-assignments')->assertStatus(401);
    }
}
