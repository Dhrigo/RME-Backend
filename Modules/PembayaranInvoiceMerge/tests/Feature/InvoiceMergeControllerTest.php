<?php

namespace Modules\PembayaranInvoiceMerge\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceMerge\Models\InvoiceMerge;
use Modules\PembayaranPayment\Models\Payment;
use Tests\TestCase;

class InvoiceMergeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_invoice_merge_with_auto_generated_number(): void
    {
        $this->actingUser();
        $payment = Payment::factory()->create();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/invoice-merges', [
            'payment_id' => $payment->id,
            'invoice_id' => $invoice->id,
            'allocated_amount' => 250000,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('MRG-'.now()->format('Y').'-', $response->json('data.merge_number'));
    }

    public function test_it_lists_invoice_merges_for_a_payment(): void
    {
        $this->actingUser();
        $payment = Payment::factory()->create();
        InvoiceMerge::factory()->count(2)->create(['payment_id' => $payment->id]);
        InvoiceMerge::factory()->create();

        $this->getJson("/api/v1/invoice-merges?payment_id={$payment->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_deletes_an_invoice_merge(): void
    {
        $this->actingUser();
        $merge = InvoiceMerge::factory()->create();

        $this->deleteJson("/api/v1/invoice-merges/{$merge->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_invoice_merges(): void
    {
        $this->getJson('/api/v1/invoice-merges')->assertStatus(401);
    }
}
