<?php

namespace Modules\PembayaranDepositRefund\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PembayaranDepositRefund\Models\DepositRefund;
use Tests\TestCase;

class DepositRefundControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_deposit_refunds(): void
    {
        $this->actingUser();
        DepositRefund::factory()->count(3)->create();

        $this->getJson('/api/v1/deposit-refunds')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_refund_and_marks_deposit_refunded(): void
    {
        $user = $this->actingUser();
        $deposit = Deposit::factory()->create(['status' => 'held', 'amount' => 500000]);

        $this->postJson('/api/v1/deposit-refunds', [
            'deposit_id' => $deposit->id,
            'refunded_amount' => 500000,
        ])->assertCreated()->assertJsonPath('data.refunded_by', $user->id);

        $this->assertDatabaseHas('deposit_refunds', ['deposit_id' => $deposit->id, 'refunded_by' => $user->id]);
        $this->assertEquals('refunded', $deposit->fresh()->status);
    }

    public function test_it_requires_refunded_amount(): void
    {
        $this->actingUser();
        $deposit = Deposit::factory()->create();

        $this->postJson('/api/v1/deposit-refunds', ['deposit_id' => $deposit->id])
            ->assertStatus(422);
    }

    public function test_it_has_no_update_or_delete_routes(): void
    {
        $this->actingUser();
        $refund = DepositRefund::factory()->create();

        $this->putJson("/api/v1/deposit-refunds/{$refund->id}", ['refunded_amount' => 1])->assertStatus(405);
        $this->deleteJson("/api/v1/deposit-refunds/{$refund->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_deposit_refunds(): void
    {
        $this->getJson('/api/v1/deposit-refunds')->assertStatus(401);
    }
}
