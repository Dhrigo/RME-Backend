<?php

namespace Modules\GeneralRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralRoom\Models\Room;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_room_under_a_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/rooms', ['ward_id' => $ward->id, 'room_number' => 'R-101'])
            ->assertCreated()
            ->assertJsonPath('room_number', 'R-101');
    }

    public function test_it_lists_rooms_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        Room::factory()->count(2)->create(['ward_id' => $ward->id]);
        Room::factory()->create();

        $this->getJson("/api/v1/rooms?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }
}
