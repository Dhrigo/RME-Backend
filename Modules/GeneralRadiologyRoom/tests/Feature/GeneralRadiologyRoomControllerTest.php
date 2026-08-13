<?php

namespace Modules\GeneralRadiologyRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralRadiologyRoom\Models\RadiologyRoom;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class GeneralRadiologyRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_radiology_room_under_a_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/radiology-rooms', [
            'ward_id' => $ward->id,
            'radiology_type' => 'rontgen',
        ])
            ->assertCreated()
            ->assertJsonPath('radiology_type', 'rontgen');
    }

    public function test_it_lists_radiology_rooms_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        RadiologyRoom::factory()->count(2)->create(['ward_id' => $ward->id]);
        RadiologyRoom::factory()->create();

        $this->getJson("/api/v1/radiology-rooms?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/radiology-rooms', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['ward_id', 'radiology_type']);
    }

    public function test_it_updates_radiology_room(): void
    {
        $this->actingUser();
        $room = RadiologyRoom::factory()->create(['radiology_type' => 'usg']);

        $this->putJson("/api/v1/radiology-rooms/{$room->id}", ['radiology_type' => 'mri'])
            ->assertOk()
            ->assertJsonPath('radiology_type', 'mri');
    }

    public function test_it_deletes_radiology_room(): void
    {
        $this->actingUser();
        $room = RadiologyRoom::factory()->create();

        $this->deleteJson("/api/v1/radiology-rooms/{$room->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('radiology_rooms', ['id' => $room->id]);
    }
}
