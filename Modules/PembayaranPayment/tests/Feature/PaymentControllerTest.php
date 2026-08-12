<?php

namespace Modules\PembayaranPayment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_payment_and_locks_invoice_when_fully_paid(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $response = $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'payment_method' => 'cash',
            'amount' => 100000,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('PAY-'.now()->format('Y').'-', $response->json('data.payment_number'));
        $this->assertTrue($invoice->fresh()->is_locked);
    }

    public function test_partial_payment_does_not_lock_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'payment_method' => 'cash',
            'amount' => 50000,
        ])->assertCreated();

        $this->assertFalse($invoice->fresh()->is_locked);
    }

    public function test_it_cannot_pay_an_already_locked_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->locked()->create();

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'payment_method' => 'cash',
            'amount' => 10000,
        ])->assertStatus(422);
    }

    public function test_it_records_who_received_the_payment(): void
    {
        $user = $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'payment_method' => 'cash',
            'amount' => 100000,
        ]);

        $this->assertDatabaseHas('payments', ['invoice_id' => $invoice->id, 'received_by' => $user->id]);
    }
}
