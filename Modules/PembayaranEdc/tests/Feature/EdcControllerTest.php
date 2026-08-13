<?php

namespace Modules\PembayaranEdc\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranEdc\Models\Edc;
use Modules\PembayaranPayment\Models\Payment;
use Tests\TestCase;

class EdcControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_an_edc_transaction(): void
    {
        $this->actingUser();
        $payment = Payment::factory()->create(['payment_method' => 'debit']);

        $response = $this->postJson('/api/v1/edc-transactions', [
            'payment_id' => $payment->id,
            'edc_reference_number' => 'EDC-0000000001',
            'bank_name' => 'BCA',
            'card_type' => 'debit',
            'card_last_four' => '1234',
            'amount' => 250000,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseHas('edc_transactions', ['payment_id' => $payment->id]);
    }

    public function test_it_rejects_duplicate_reference_number(): void
    {
        $this->actingUser();
        Edc::factory()->create(['edc_reference_number' => 'EDC-0000000002']);
        $payment = Payment::factory()->create();

        $this->postJson('/api/v1/edc-transactions', [
            'payment_id' => $payment->id,
            'edc_reference_number' => 'EDC-0000000002',
            'bank_name' => 'BCA',
            'card_type' => 'debit',
            'amount' => 100000,
        ])->assertStatus(422);
    }

    public function test_it_approves_a_pending_transaction(): void
    {
        $this->actingUser();
        $edc = Edc::factory()->create();

        $this->putJson("/api/v1/edc-transactions/{$edc->id}", ['status' => 'approved'])
            ->assertOk()
            ->assertJsonPath('data.status', 'approved');
    }

    public function test_it_cannot_reprocess_an_already_approved_transaction(): void
    {
        $this->actingUser();
        $edc = Edc::factory()->create(['status' => 'approved']);

        $this->putJson("/api/v1/edc-transactions/{$edc->id}", ['status' => 'declined'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_edc_transactions(): void
    {
        $this->getJson('/api/v1/edc-transactions')->assertStatus(401);
    }
}
