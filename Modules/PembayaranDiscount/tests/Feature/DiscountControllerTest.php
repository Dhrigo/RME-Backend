<?php

namespace Modules\PembayaranDiscount\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranDiscount\Models\Discount;
use Tests\TestCase;

class DiscountControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_discounts(): void
    {
        $this->actingUser();
        Discount::factory()->count(3)->create();

        $this->getJson('/api/v1/discounts')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_discount(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/discounts', [
            'code' => 'DISC-NEW',
            'name' => 'Diskon Karyawan',
            'discount_type' => 'percentage',
            'value' => 10,
        ])->assertCreated()->assertJsonPath('code', 'DISC-NEW');

        $this->assertDatabaseHas('discounts', ['code' => 'DISC-NEW', 'discount_type' => 'percentage']);
    }

    public function test_it_rejects_invalid_discount_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/discounts', [
            'code' => 'DISC-BAD',
            'name' => 'Bad',
            'discount_type' => 'unknown',
            'value' => 10,
        ])->assertStatus(422);
    }

    public function test_it_updates_discount(): void
    {
        $this->actingUser();
        $discount = Discount::factory()->create(['value' => 10]);

        $this->putJson("/api/v1/discounts/{$discount->id}", ['value' => 20])
            ->assertOk()
            ->assertJsonPath('value', '20.00');
    }

    public function test_it_deletes_discount(): void
    {
        $this->actingUser();
        $discount = Discount::factory()->create();

        $this->deleteJson("/api/v1/discounts/{$discount->id}")->assertStatus(204);
        $this->assertDatabaseMissing('discounts', ['id' => $discount->id]);
    }

    public function test_guest_cannot_access_discounts(): void
    {
        $this->getJson('/api/v1/discounts')->assertStatus(401);
    }
}
