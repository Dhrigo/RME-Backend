<?php

namespace Modules\GeneralOtherServiceTariff\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralOtherService\Models\OtherService;
use Modules\GeneralOtherServiceTariff\Models\OtherServiceTariff;
use Tests\TestCase;

class OtherServiceTariffControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_tariffs(): void
    {
        $this->actingUser();
        OtherServiceTariff::factory()->count(3)->create();

        $this->getJson('/api/v1/other-service-tariffs')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_tariff(): void
    {
        $this->actingUser();
        $service = OtherService::factory()->create();

        $this->postJson('/api/v1/other-service-tariffs', [
            'other_service_id' => $service->id,
            'price' => 75000,
            'effective_date' => '2026-01-01',
        ])->assertCreated()->assertJsonPath('data.price', '75000.00');

        $this->assertDatabaseHas('other_service_tariffs', ['other_service_id' => $service->id]);
    }

    public function test_it_rejects_unknown_other_service(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/other-service-tariffs', [
            'other_service_id' => 99999,
            'price' => 10000,
        ])->assertStatus(422);
    }

    public function test_it_updates_tariff(): void
    {
        $this->actingUser();
        $tariff = OtherServiceTariff::factory()->create(['price' => 50000]);

        $this->putJson("/api/v1/other-service-tariffs/{$tariff->id}", ['price' => 60000])
            ->assertOk()
            ->assertJsonPath('data.price', '60000.00');
    }

    public function test_it_deletes_tariff(): void
    {
        $this->actingUser();
        $tariff = OtherServiceTariff::factory()->create();

        $this->deleteJson("/api/v1/other-service-tariffs/{$tariff->id}")->assertStatus(204);
        $this->assertDatabaseMissing('other_service_tariffs', ['id' => $tariff->id]);
    }
}
