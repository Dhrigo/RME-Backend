<?php

namespace Modules\GeneralDoctor\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralEmployee\Models\Employee;

class DoctorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_doctors()
    {
        Doctor::factory()->count(3)->create();
        $response = $this->getJson('/api/doctors');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_doctor()
    {
        $employee = Employee::factory()->create();
        $data = [
            'employee_id' => $employee->id,
            'specialization' => 'Cardiologist',
            'sip_number' => 'SIP-12345',
            'is_active' => true,
        ];
        $response = $this->postJson('/api/doctors', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('doctors', $data);
    }

    public function test_can_show_doctor()
    {
        $doctor = Doctor::factory()->create();
        $response = $this->getJson("/api/doctors/{$doctor->id}");
        $response->assertOk()->assertJsonPath('data.id', $doctor->id);
    }

    public function test_can_update_doctor()
    {
        $doctor = Doctor::factory()->create(['specialization' => 'Old']);
        $response = $this->putJson("/api/doctors/{$doctor->id}", [
            'specialization' => 'New',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('doctors', [
            'id' => $doctor->id,
            'specialization' => 'New',
        ]);
    }

    public function test_can_delete_doctor()
    {
        $doctor = Doctor::factory()->create();
        $response = $this->deleteJson("/api/doctors/{$doctor->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('doctors', ['id' => $doctor->id]);
    }
}
