<?php

namespace Modules\GeneralStaffMember\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Auth\Models\User;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralEmployee\Models\Employee;

class StaffMemberTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_can_list_staff_members()
    {
        $this->actingUser();
        StaffMember::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/staff-members');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_staff_member()
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        $data = [
            'employee_id' => $employee->id,
            'staff_role' => 'Administrator',
            'is_active' => true,
        ];
        $response = $this->postJson('/api/v1/staff-members', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('staff_members', $data);
    }

    public function test_can_show_staff_member()
    {
        $this->actingUser();
        $staffMember = StaffMember::factory()->create();
        $response = $this->getJson("/api/v1/staff-members/{$staffMember->id}");
        $response->assertOk()->assertJsonPath('data.id', $staffMember->id);
    }

    public function test_can_update_staff_member()
    {
        $this->actingUser();
        $staffMember = StaffMember::factory()->create(['staff_role' => 'Old']);
        $response = $this->putJson("/api/v1/staff-members/{$staffMember->id}", [
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
        $this->actingUser();
        $staffMember = StaffMember::factory()->create();
        $response = $this->deleteJson("/api/v1/staff-members/{$staffMember->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('staff_members', ['id' => $staffMember->id]);
    }

    public function test_guest_cannot_access_staff_members(): void
    {
        $this->getJson('/api/v1/staff-members')->assertStatus(401);
    }
}
