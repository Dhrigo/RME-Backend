<?php

namespace Modules\GeneralAdministrationTariff\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAdministrationTariff\Models\AdministrationTariff;
use Tests\TestCase;

class AdministrationTariffControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        AdministrationTariff::factory()->count(3)->create();

        $this->getJson('/api/v1/administration-tariffs')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = AdministrationTariff::factory()->make()->toArray();
        $this->postJson('/api/v1/administration-tariffs', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = AdministrationTariff::factory()->create();
        $payload = AdministrationTariff::factory()->make()->toArray();
        $this->putJson("/api/v1/administration-tariffs/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = AdministrationTariff::factory()->create();
        $this->deleteJson("/api/v1/administration-tariffs/{$item->id}")->assertStatus(204);
    }
}
