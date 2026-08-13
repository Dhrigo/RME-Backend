<?php

namespace Modules\GeneralWardClassAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralRoomClass\Models\RoomClass;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardClassAssignment\Models\WardClassAssignment;
use Tests\TestCase;

class GeneralWardClassAssignmentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_ward_class_assignment(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $roomClass = RoomClass::factory()->create();

        $this->postJson('/api/v1/ward-class-assignments', [
            'ward_id' => $ward->id,
            'room_class_id' => $roomClass->id,
        ])
            ->assertCreated()
            ->assertJsonPath('room_class_id', $roomClass->id);
    }

    public function test_it_lists_assignments_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        WardClassAssignment::factory()->count(2)->create(['ward_id' => $ward->id]);
        WardClassAssignment::factory()->create();

        $this->getJson("/api/v1/ward-class-assignments?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ward-class-assignments', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['ward_id', 'room_class_id']);
    }

    public function test_it_rejects_duplicate_assignment(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $roomClass = RoomClass::factory()->create();
        WardClassAssignment::factory()->create(['ward_id' => $ward->id, 'room_class_id' => $roomClass->id]);

        $this->postJson('/api/v1/ward-class-assignments', [
            'ward_id' => $ward->id,
            'room_class_id' => $roomClass->id,
        ])->assertStatus(500);
    }

    public function test_it_deletes_assignment(): void
    {
        $this->actingUser();
        $assignment = WardClassAssignment::factory()->create();

        $this->deleteJson("/api/v1/ward-class-assignments/{$assignment->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('ward_class_assignments', ['id' => $assignment->id]);
    }
}
