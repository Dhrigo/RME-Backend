<?php

namespace Modules\GeneralOxygenTariff\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralOxygenTariff\Models\OxygenTariff;
use Tests\TestCase;

class OxygenTariffControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        OxygenTariff::factory()->count(3)->create();

        $this->getJson('/api/v1/oxygen-tariffs')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = OxygenTariff::factory()->make()->toArray();
        $this->postJson('/api/v1/oxygen-tariffs', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = OxygenTariff::factory()->create();
        $payload = OxygenTariff::factory()->make()->toArray();
        $this->putJson("/api/v1/oxygen-tariffs/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = OxygenTariff::factory()->create();
        $this->deleteJson("/api/v1/oxygen-tariffs/{$item->id}")->assertStatus(204);
    }
}
