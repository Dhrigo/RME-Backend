<?php

namespace Modules\GeneralStaffMember\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralEmployee\Models\Employee;

class StaffMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_staff_members()
    {
        StaffMember::factory()->count(3)->create();
        $response = $this->getJson('/api/staff-members');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_staff_member()
    {
        $employee = Employee::factory()->create();
        $data = [
            'employee_id' => $employee->id,
            'staff_role' => 'Administrator',
            'is_active' => true,
        ];
        $response = $this->postJson('/api/staff-members', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('staff_members', $data);
    }

    public function test_can_show_staff_member()
    {
        $staffMember = StaffMember::factory()->create();
        $response = $this->getJson("/api/staff-members/{$staffMember->id}");
        $response->assertOk()->assertJsonPath('data.id', $staffMember->id);
    }

    public function test_can_update_staff_member()
    {
        $staffMember = StaffMember::factory()->create(['staff_role' => 'Old']);
        $response = $this->putJson("/api/staff-members/{$staffMember->id}", [
            'staff_role' => 'New',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('staff_members', [
            'id' => $staffMember->id,
            'staff_role' => 'New',
        ]);
    }

    public function test_can_delete_staff_member()
    {
        $staffMember = StaffMember::factory()->create();
        $response = $this->deleteJson("/api/staff-members/{$staffMember->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('staff_members', ['id' => $staffMember->id]);
    }
}
