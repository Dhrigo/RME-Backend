<?php

namespace Modules\GeneralStaffWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\GeneralStaffWardAssignment\Models\StaffWardAssignment;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralWard\Models\Ward;

class StaffWardAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_assignments()
    {
        StaffWardAssignment::factory()->count(3)->create();
        $response = $this->getJson('/api/staff-ward-assignments');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_assignment()
    {
        $staffMember = StaffMember::factory()->create();
        $ward = Ward::factory()->create();
        $data = [
            'staff_member_id' => $staffMember->id,
            'ward_id' => $ward->id,
            'assigned_at' => now()->format('Y-m-d H:i:s'),
        ];
        $response = $this->postJson('/api/staff-ward-assignments', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('staff_ward_assignments', $data);
    }

    public function test_can_show_assignment()
    {
        $assignment = StaffWardAssignment::factory()->create();
        $response = $this->getJson("/api/staff-ward-assignments/{$assignment->id}");
        $response->assertOk()->assertJsonPath('data.id', $assignment->id);
    }

    public function test_can_update_assignment()
    {
        $assignment = StaffWardAssignment::factory()->create(['assigned_at' => '2026-08-13 10:00:00']);
        $response = $this->putJson("/api/staff-ward-assignments/{$assignment->id}", [
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
        $assignment = StaffWardAssignment::factory()->create();
        $response = $this->deleteJson("/api/staff-ward-assignments/{$assignment->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('staff_ward_assignments', ['id' => $assignment->id]);
    }
}
