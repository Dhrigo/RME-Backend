<?php

namespace Modules\GeneralPharmacyTariffByRoomClass\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPharmacyTariffByRoomClass\Models\PharmacyTariffByRoomClass;
use Tests\TestCase;

class PharmacyTariffByRoomClassControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        PharmacyTariffByRoomClass::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-tariff-by-room-classes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = PharmacyTariffByRoomClass::factory()->make()->toArray();
        $this->postJson('/api/v1/pharmacy-tariff-by-room-classes', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = PharmacyTariffByRoomClass::factory()->create();
        $payload = PharmacyTariffByRoomClass::factory()->make()->toArray();
        $this->putJson("/api/v1/pharmacy-tariff-by-room-classes/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = PharmacyTariffByRoomClass::factory()->create();
        $this->deleteJson("/api/v1/pharmacy-tariff-by-room-classes/{$item->id}")->assertStatus(204);
    }
}
