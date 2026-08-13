<?php

namespace Modules\GeneralPharmacyRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPharmacyRoom\Models\PharmacyRoom;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class GeneralPharmacyRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_pharmacy_room_under_a_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/pharmacy-rooms', [
            'ward_id' => $ward->id,
            'pharmacy_type' => 'rawat_jalan',
        ])
            ->assertCreated()
            ->assertJsonPath('pharmacy_type', 'rawat_jalan');
    }

    public function test_it_lists_pharmacy_rooms_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        PharmacyRoom::factory()->count(2)->create(['ward_id' => $ward->id]);
        PharmacyRoom::factory()->create();

        $this->getJson("/api/v1/pharmacy-rooms?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pharmacy-rooms', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['ward_id', 'pharmacy_type']);
    }

    public function test_it_updates_pharmacy_room(): void
    {
        $this->actingUser();
        $room = PharmacyRoom::factory()->create(['pharmacy_type' => 'igd']);

        $this->putJson("/api/v1/pharmacy-rooms/{$room->id}", ['pharmacy_type' => 'rawat_inap'])
            ->assertOk()
            ->assertJsonPath('pharmacy_type', 'rawat_inap');
    }

    public function test_it_deletes_pharmacy_room(): void
    {
        $this->actingUser();
        $room = PharmacyRoom::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-rooms/{$room->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('pharmacy_rooms', ['id' => $room->id]);
    }
}
