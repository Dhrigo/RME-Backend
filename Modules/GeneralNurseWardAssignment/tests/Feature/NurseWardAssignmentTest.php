<?php

namespace Modules\GeneralNurseWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Auth\Models\User;
use Modules\GeneralNurseWardAssignment\Models\NurseWardAssignment;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralWard\Models\Ward;

class NurseWardAssignmentTest extends TestCase
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
        NurseWardAssignment::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/nurse-ward-assignments');
        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_can_filter_by_ward()
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        NurseWardAssignment::factory()->create(['ward_id' => $ward->id]);
        NurseWardAssignment::factory()->create();
        $response = $this->getJson("/api/v1/nurse-ward-assignments?ward_id={$ward->id}");
        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_can_create_assignment()
    {
        $this->actingUser();
        $nurse = Nurse::factory()->create();
        $ward = Ward::factory()->create();
        $data = [
            'nurse_id' => $nurse->id,
            'ward_id' => $ward->id,
            'shift' => 'Morning',
            'assigned_at' => now()->format('Y-m-d H:i:s'),
        ];
        $response = $this->postJson('/api/v1/nurse-ward-assignments', $data);
        $response->assertCreated();
        $this->assertDatabaseHas('nurse_ward_assignments', $data);
    }

    public function test_can_show_assignment()
    {
        $this->actingUser();
        $assignment = NurseWardAssignment::factory()->create();
        $response = $this->getJson("/api/v1/nurse-ward-assignments/{$assignment->id}");
        $response->assertOk()->assertJsonPath('data.id', $assignment->id);
    }

    public function test_can_update_assignment()
    {
        $this->actingUser();
        $assignment = NurseWardAssignment::factory()->create(['shift' => 'Morning']);
        $response = $this->putJson("/api/v1/nurse-ward-assignments/{$assignment->id}", [
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
        $this->actingUser();
        $assignment = NurseWardAssignment::factory()->create();
        $response = $this->deleteJson("/api/v1/nurse-ward-assignments/{$assignment->id}");
        $response->assertNoContent();
        $this->assertDatabaseMissing('nurse_ward_assignments', ['id' => $assignment->id]);
    }

    public function test_guest_cannot_access_nurse_ward_assignments(): void
    {
        $this->getJson('/api/v1/nurse-ward-assignments')->assertStatus(401);
    }
}
