<?php

namespace Modules\GeneralService\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralService\Models\Service;
use Modules\GeneralServiceTariff\Models\ServiceTariff;
use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_services(): void
    {
        $this->actingUser();
        Service::factory()->count(2)->create();

        $this->getJson('/api/v1/services')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_creates_service(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/services', ['name' => 'Konsultasi Umum'])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Konsultasi Umum');
    }

    public function test_it_shows_current_price_from_active_tariff(): void
    {
        $this->actingUser();
        $service = Service::factory()->create();
        ServiceTariff::factory()->create([
            'service_id' => $service->id,
            'price' => 75000,
            'effective_date' => now()->subDay(),
        ]);

        $this->getJson("/api/v1/services/{$service->id}")
            ->assertOk()
            ->assertJsonPath('data.current_price', '75000.00');
    }

    public function test_it_deletes_service(): void
    {
        $this->actingUser();
        $service = Service::factory()->create();

        $this->deleteJson("/api/v1/services/{$service->id}")->assertStatus(204);
    }
}
