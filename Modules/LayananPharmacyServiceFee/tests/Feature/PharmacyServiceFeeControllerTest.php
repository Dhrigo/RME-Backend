<?php

namespace Modules\LayananPharmacyServiceFee\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPharmacyServiceFee\Models\PharmacyServiceFee;
use Tests\TestCase;

class PharmacyServiceFeeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_service_fees(): void
    {
        $this->actingUser();
        PharmacyServiceFee::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-service-fees')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_service_fee(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pharmacy-service-fees', [
            'fee_name' => 'Test Fee_name',
            'amount' => 12.5,
        ])->assertCreated();

        $this->assertDatabaseCount('pharmacy_service_fees', 1);
    }

    public function test_it_deletes_service_fee(): void
    {
        $this->actingUser();
        $service_fee = PharmacyServiceFee::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-service-fees/{$service_fee->id}")->assertStatus(204);
        $this->assertDatabaseMissing('pharmacy_service_fees', ['id' => $service_fee->id]);
    }

    public function test_it_shows_service_fee(): void
    {
        $this->actingUser();
        $service_fee = PharmacyServiceFee::factory()->create();

        $this->getJson("/api/v1/pharmacy-service-fees/{$service_fee->id}")->assertOk()->assertJsonPath('data.id', $service_fee->id);
    }

}
