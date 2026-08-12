<?php

namespace Modules\GeneralBed\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralRoom\Models\Room;
use Tests\TestCase;

class BedControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_bed_under_a_room(): void
    {
        $this->actingUser();
        $room = Room::factory()->create();

        $this->postJson('/api/v1/beds', ['room_id' => $room->id, 'bed_number' => 'B-01'])
            ->assertCreated()
            ->assertJsonPath('bed_number', 'B-01');
    }

    public function test_it_lists_beds_filtered_by_room(): void
    {
        $this->actingUser();
        $room = Room::factory()->create();
        Bed::factory()->count(2)->create(['room_id' => $room->id]);
        Bed::factory()->create();

        $this->getJson("/api/v1/beds?room_id={$room->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }
}
