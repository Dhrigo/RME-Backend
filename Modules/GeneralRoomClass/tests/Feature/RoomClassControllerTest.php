<?php

namespace Modules\GeneralRoomClass\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralRoomClass\Models\RoomClass;
use Tests\TestCase;

class RoomClassControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_room_class(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/room-classes', ['name' => 'VIP', 'code' => 'VIP'])
            ->assertCreated()
            ->assertJsonPath('name', 'VIP');
    }

    public function test_it_lists_room_classes(): void
    {
        $this->actingUser();
        RoomClass::factory()->count(3)->create();

        $this->getJson('/api/v1/room-classes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_deletes_room_class(): void
    {
        $this->actingUser();
        $roomClass = RoomClass::factory()->create();

        $this->deleteJson("/api/v1/room-classes/{$roomClass->id}")->assertStatus(204);
    }
}
