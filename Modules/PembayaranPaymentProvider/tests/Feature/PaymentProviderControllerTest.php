<?php

namespace Modules\PembayaranPaymentProvider\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;
use Tests\TestCase;

class PaymentProviderControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_payment_providers(): void
    {
        $this->actingUser();
        PaymentProvider::factory()->count(3)->create();

        $this->getJson('/api/v1/payment-providers')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_a_payment_provider(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/payment-providers', [
            'provider_name' => 'Midtrans',
            'provider_type' => 'aggregator',
            'merchant_id' => 'MID0001',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('payment_providers', ['provider_name' => 'Midtrans', 'provider_type' => 'aggregator']);
    }

    public function test_it_rejects_invalid_provider_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/payment-providers', [
            'provider_name' => 'Unknown',
            'provider_type' => 'not_a_valid_type',
        ])->assertStatus(422);
    }

    public function test_it_updates_a_payment_provider(): void
    {
        $this->actingUser();
        $provider = PaymentProvider::factory()->create();

        $this->putJson("/api/v1/payment-providers/{$provider->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_a_payment_provider(): void
    {
        $this->actingUser();
        $provider = PaymentProvider::factory()->create();

        $this->deleteJson("/api/v1/payment-providers/{$provider->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_payment_providers(): void
    {
        $this->getJson('/api/v1/payment-providers')->assertStatus(401);
    }
}
