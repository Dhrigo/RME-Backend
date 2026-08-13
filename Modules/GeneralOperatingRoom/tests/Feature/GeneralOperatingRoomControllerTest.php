<?php

namespace Modules\GeneralOperatingRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralOperatingRoom\Models\OperatingRoom;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class GeneralOperatingRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_operating_room_under_a_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/operating-rooms', [
            'ward_id' => $ward->id,
            'room_number' => 'OK-01',
            'equipment_notes' => 'CT scan portabel',
        ])
            ->assertCreated()
            ->assertJsonPath('room_number', 'OK-01')
            ->assertJsonPath('equipment_notes', 'CT scan portabel');
    }

    public function test_it_creates_operating_room_without_equipment_notes(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/operating-rooms', [
            'ward_id' => $ward->id,
            'room_number' => 'OK-02',
        ])
            ->assertCreated()
            ->assertJsonPath('equipment_notes', null);
    }

    public function test_it_lists_operating_rooms_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        OperatingRoom::factory()->count(2)->create(['ward_id' => $ward->id]);
        OperatingRoom::factory()->create();

        $this->getJson("/api/v1/operating-rooms?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/operating-rooms', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['ward_id', 'room_number']);
    }

    public function test_it_updates_operating_room(): void
    {
        $this->actingUser();
        $room = OperatingRoom::factory()->create(['room_number' => 'OK-03']);

        $this->putJson("/api/v1/operating-rooms/{$room->id}", ['room_number' => 'OK-04'])
            ->assertOk()
            ->assertJsonPath('room_number', 'OK-04');
    }

    public function test_it_deletes_operating_room(): void
    {
        $this->actingUser();
        $room = OperatingRoom::factory()->create();

        $this->deleteJson("/api/v1/operating-rooms/{$room->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('operating_rooms', ['id' => $room->id]);
    }
}
