<?php

namespace Modules\GeneralServiceTariff\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralService\Models\Service;
use Modules\GeneralServiceTariff\Models\ServiceTariff;
use Tests\TestCase;

class ServiceTariffControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_tariff_for_a_service(): void
    {
        $user = $this->actingUser();
        $service = Service::factory()->create();

        $response = $this->postJson('/api/v1/service-tariffs', [
            'service_id' => $service->id,
            'price' => 120000,
            'effective_date' => now()->toDateString(),
        ]);

        $response->assertCreated()->assertJsonPath('data.price', '120000.00');
        $this->assertDatabaseHas('service_tariffs', ['service_id' => $service->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_tariffs_filtered_by_service(): void
    {
        $this->actingUser();
        $service = Service::factory()->create();
        ServiceTariff::factory()->count(2)->create(['service_id' => $service->id]);
        ServiceTariff::factory()->create();

        $this->getJson("/api/v1/service-tariffs?service_id={$service->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_deletes_tariff(): void
    {
        $this->actingUser();
        $tariff = ServiceTariff::factory()->create();

        $this->deleteJson("/api/v1/service-tariffs/{$tariff->id}")->assertStatus(204);
    }
}
