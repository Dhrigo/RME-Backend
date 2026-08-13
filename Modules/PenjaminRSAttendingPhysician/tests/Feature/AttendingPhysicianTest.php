<?php

namespace Modules\PenjaminRSAttendingPhysician\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PenjaminRSAttendingPhysician\Models\AttendingPhysician;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralEmployee\Models\Employee;
use Modules\Auth\Models\User;

class AttendingPhysicianTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_can_list_attending_physicians()
    {
        AttendingPhysician::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/attending-physicians');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_attending_physician()
    {
        $visit = Visit::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/attending-physicians', [
            'visit_id' => $visit->id,
            'employee_id' => $employee->id,
            'is_primary' => true
        ]);

        $response->assertStatus(201)->assertJsonFragment(['is_primary' => true]);
        $this->assertDatabaseHas('attending_physicians', ['visit_id' => $visit->id]);
    }

    public function test_can_update_attending_physician()
    {
        $attending = AttendingPhysician::factory()->create(['is_primary' => false]);

        $response = $this->putJson("/api/v1/attending-physicians/{$attending->id}", [
            'is_primary' => true
        ]);

        $response->assertStatus(200);
        $this->assertTrue($attending->fresh()->is_primary);
    }

    public function test_can_delete_attending_physician()
    {
        $attending = AttendingPhysician::factory()->create();

        $response = $this->deleteJson("/api/v1/attending-physicians/{$attending->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('attending_physicians', ['id' => $attending->id]);
    }
}
