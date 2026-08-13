<?php

namespace Modules\GeneralNurseWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\GeneralNurseWardAssignment\Models\NurseWardAssignment;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralWard\Models\Ward;

class NurseWardAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_assignments()
    {
        NurseWardAssignment::factory()->count(3)->create();
        $response = $this->getJson('/api/nurse-ward-assignments');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_create_assignment()
    {
        $nurse = Nurse::factory()->create();
        $ward = Ward::factory()->create();
        $data = [
            'nurse_id' => $nurse->id,
            'ward_id' => $ward->id,
            'shift' => 'Morning',
            'assigned_at' => now()->format('Y-m-d H:i:s'),
        ];
        $response = $this->postJson('/api/nurse-ward-assignments', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('nurse_ward_assignments', $data);
    }

    public function test_can_show_assignment()
    {
        $assignment = NurseWardAssignment::factory()->create();
        $response = $this->getJson("/api/nurse-ward-assignments/{$assignment->id}");
        $response->assertOk()->assertJsonPath('data.id', $assignment->id);
    }

    public function test_can_update_assignment()
    {
        $assignment = NurseWardAssignment::factory()->create(['shift' => 'Morning']);
        $response = $this->putJson("/api/nurse-ward-assignments/{$assignment->id}", [
            'shift' => 'Night',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('nurse_ward_assignments', [
            'id' => $assignment->id,
            'shift' => 'Night',
        ]);
    }

    public function test_can_delete_assignment()
    {
        $assignment = NurseWardAssignment::factory()->create();
        $response = $this->deleteJson("/api/nurse-ward-assignments/{$assignment->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('nurse_ward_assignments', ['id' => $assignment->id]);
    }
}
