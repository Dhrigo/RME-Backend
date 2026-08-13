<?php

namespace Modules\PendaftaranCoManagement\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranCoManagement\Models\CoManagement;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class CoManagementControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_comanagements(): void
    {
        CoManagement::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/comanagements');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_comanagement(): void
    {
        $visit = Visit::factory()->create();
        $employee = Employee::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'employee_id' => $employee->id,
            'started_at' => now()->toDateTimeString(),
            'notes' => 'Joint consultation',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/comanagements', $data);

        $response->assertCreated()
            ->assertJsonPath('data.notes', 'Joint consultation');

        $this->assertDatabaseHas('co_managements', $data);
    }

    public function test_can_show_comanagement(): void
    {
        $comanagement = CoManagement::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/comanagements/{$comanagement->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $comanagement->id);
    }
}
