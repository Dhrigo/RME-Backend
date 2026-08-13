<?php

namespace Modules\GeneralRoomClassReferenceGroup\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralRoomClassReferenceGroup\Models\RoomClassReferenceGroup;
use Tests\TestCase;

class RoomClassReferenceGroupControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_room_class_reference_groups(): void
    {
        $this->actingUser();
        RoomClassReferenceGroup::factory()->count(3)->create();

        $this->getJson('/api/v1/room-class-reference-groups')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_room_class_reference_group(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/room-class-reference-groups', ['name' => 'Kelas VIP', 'code' => 'VIP'])
            ->assertCreated()
            ->assertJsonPath('name', 'Kelas VIP');

        $this->assertDatabaseHas('room_class_reference_groups', ['name' => 'Kelas VIP']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        RoomClassReferenceGroup::factory()->create(['name' => 'Kelas VIP']);

        $this->postJson('/api/v1/room-class-reference-groups', ['name' => 'Kelas VIP'])->assertStatus(422);
    }

    public function test_it_deletes_room_class_reference_group(): void
    {
        $this->actingUser();
        $group = RoomClassReferenceGroup::factory()->create();

        $this->deleteJson("/api/v1/room-class-reference-groups/{$group->id}")->assertStatus(204);
        $this->assertDatabaseMissing('room_class_reference_groups', ['id' => $group->id]);
    }
}
