<?php

namespace Modules\GeneralNurse\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralEmployee\Models\Employee;

class NurseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_nurses()
    {
        Nurse::factory()->count(3)->create();
        $response = $this->getJson('/api/nurses');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_nurse()
    {
        $employee = Employee::factory()->create();
        $data = [
            'employee_id' => $employee->id,
            'nurse_license_number' => 'NURSE-12345',
            'is_active' => true,
        ];
        $response = $this->postJson('/api/nurses', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('nurses', $data);
    }

    public function test_can_show_nurse()
    {
        $nurse = Nurse::factory()->create();
        $response = $this->getJson("/api/nurses/{$nurse->id}");
        $response->assertOk()->assertJsonPath('data.id', $nurse->id);
    }

    public function test_can_update_nurse()
    {
        $nurse = Nurse::factory()->create(['nurse_license_number' => 'Old']);
        $response = $this->putJson("/api/nurses/{$nurse->id}", [
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
        $nurse = Nurse::factory()->create();
        $response = $this->deleteJson("/api/nurses/{$nurse->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('nurses', ['id' => $nurse->id]);
    }
}
