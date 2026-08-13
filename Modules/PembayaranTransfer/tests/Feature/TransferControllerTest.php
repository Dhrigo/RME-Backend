<?php

namespace Modules\PembayaranTransfer\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PembayaranTransfer\Models\Transfer;
use Tests\TestCase;

class TransferControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_a_bank_transfer(): void
    {
        $this->actingUser();
        $payment = Payment::factory()->create(['payment_method' => 'transfer']);

        $response = $this->postJson('/api/v1/bank-transfers', [
            'payment_id' => $payment->id,
            'transfer_reference_number' => 'TRF-0000000001',
            'source_bank_name' => 'BCA',
            'destination_account_number' => '1234567890',
            'destination_account_name' => 'RSU Simgos',
            'amount' => 500000,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseHas('bank_transfers', ['payment_id' => $payment->id]);
    }

    public function test_it_rejects_duplicate_reference_number(): void
    {
        $this->actingUser();
        Transfer::factory()->create(['transfer_reference_number' => 'TRF-0000000002']);
        $payment = Payment::factory()->create();

        $this->postJson('/api/v1/bank-transfers', [
            'payment_id' => $payment->id,
            'transfer_reference_number' => 'TRF-0000000002',
            'source_bank_name' => 'BCA',
            'destination_account_number' => '1234567890',
            'destination_account_name' => 'RSU Simgos',
            'amount' => 100000,
        ])->assertStatus(422);
    }

    public function test_it_verifies_a_pending_transfer(): void
    {
        $this->actingUser();
        $transfer = Transfer::factory()->create();

        $this->putJson("/api/v1/bank-transfers/{$transfer->id}", ['status' => 'verified'])
            ->assertOk()
            ->assertJsonPath('data.status', 'verified');
    }

    public function test_it_cannot_reprocess_an_already_verified_transfer(): void
    {
        $this->actingUser();
        $transfer = Transfer::factory()->create(['status' => 'verified']);

        $this->putJson("/api/v1/bank-transfers/{$transfer->id}", ['status' => 'rejected'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_bank_transfers(): void
    {
        $this->getJson('/api/v1/bank-transfers')->assertStatus(401);
    }
}
