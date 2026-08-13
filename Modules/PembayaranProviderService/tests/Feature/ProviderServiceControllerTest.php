<?php

namespace Modules\PembayaranProviderService\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;
use Modules\PembayaranProviderService\Models\ProviderService;
use Tests\TestCase;

class ProviderServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_provider_services(): void
    {
        $this->actingUser();
        ProviderService::factory()->count(3)->create();

        $this->getJson('/api/v1/provider-services')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_a_provider_service(): void
    {
        $this->actingUser();
        $provider = PaymentProvider::factory()->create();

        $response = $this->postJson('/api/v1/provider-services', [
            'payment_provider_id' => $provider->id,
            'service_name' => 'QRIS',
            'service_type' => 'qris',
            'admin_fee_type' => 'percentage',
            'admin_fee_amount' => 0.7,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('provider_services', ['service_name' => 'QRIS', 'payment_provider_id' => $provider->id]);
    }

    public function test_it_requires_an_existing_payment_provider(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/provider-services', [
            'payment_provider_id' => 999999,
            'service_name' => 'QRIS',
        ])->assertStatus(422);
    }

    public function test_it_updates_a_provider_service(): void
    {
        $this->actingUser();
        $service = ProviderService::factory()->create();

        $this->putJson("/api/v1/provider-services/{$service->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_a_provider_service(): void
    {
        $this->actingUser();
        $service = ProviderService::factory()->create();

        $this->deleteJson("/api/v1/provider-services/{$service->id}")->assertStatus(204);
    }
}
