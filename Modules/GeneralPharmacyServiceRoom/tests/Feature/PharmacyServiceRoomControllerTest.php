<?php

namespace Modules\GeneralPharmacyServiceRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPharmacyServiceRoom\Models\PharmacyServiceRoom;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class PharmacyServiceRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_rooms(): void
    {
        $this->actingUser();
        PharmacyServiceRoom::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-service-rooms')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_room(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/pharmacy-service-rooms', [
            'ward_id' => $ward->id,
            'service_type' => 'rawat_inap',
        ])->assertCreated()->assertJsonPath('data.service_type', 'rawat_inap');

        $this->assertDatabaseHas('pharmacy_service_rooms', ['ward_id' => $ward->id, 'service_type' => 'rawat_inap']);
    }

    public function test_it_requires_service_type(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/pharmacy-service-rooms', ['ward_id' => $ward->id])->assertStatus(422);
    }

    public function test_it_updates_room(): void
    {
        $this->actingUser();
        $room = PharmacyServiceRoom::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/pharmacy-service-rooms/{$room->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_room(): void
    {
        $this->actingUser();
        $room = PharmacyServiceRoom::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-service-rooms/{$room->id}")->assertStatus(204);
        $this->assertDatabaseMissing('pharmacy_service_rooms', ['id' => $room->id]);
    }
}
