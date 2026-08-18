<?php

namespace Modules\GeneralNurse\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Auth\Models\User;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralEmployee\Models\Employee;

class NurseTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_can_list_nurses()
    {
        $this->actingUser();
        Nurse::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/nurses');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_nurse()
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        $data = [
            'employee_id' => $employee->id,
            'nurse_license_number' => 'NURSE-12345',
            'is_active' => true,
        ];
        $response = $this->postJson('/api/v1/nurses', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('nurses', $data);
    }

    public function test_can_show_nurse()
    {
        $this->actingUser();
        $nurse = Nurse::factory()->create();
        $response = $this->getJson("/api/v1/nurses/{$nurse->id}");
        $response->assertOk()->assertJsonPath('data.id', $nurse->id);
    }

    public function test_can_update_nurse()
    {
        $this->actingUser();
        $nurse = Nurse::factory()->create(['nurse_license_number' => 'Old']);
        $response = $this->putJson("/api/v1/nurses/{$nurse->id}", [
            'nurse_license_number' => 'New',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('nurses', [
            'id' => $nurse->id,
            'nurse_license_number' => 'New',
        ]);
    }

    public function test_can_delete_nurse()
    {
        $this->actingUser();
        $nurse = Nurse::factory()->create();
        $response = $this->deleteJson("/api/v1/nurses/{$nurse->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('nurses', ['id' => $nurse->id]);
    }

    public function test_guest_cannot_access_nurses(): void
    {
        $this->getJson('/api/v1/nurses')->assertStatus(401);
    }
}
