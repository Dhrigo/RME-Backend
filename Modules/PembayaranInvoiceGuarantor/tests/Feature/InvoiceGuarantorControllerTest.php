<?php

namespace Modules\PembayaranInvoiceGuarantor\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class InvoiceGuarantorControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_invoice_guarantors(): void
    {
        $this->actingUser();
        InvoiceGuarantor::factory()->count(3)->create();

        $this->getJson('/api/v1/invoice-guarantors')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_an_invoice_guarantor(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->create();

        $response = $this->postJson('/api/v1/invoice-guarantors', [
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'covered_amount' => 1500000,
            'coverage_percentage' => 80,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('invoice_guarantors', ['invoice_id' => $invoice->id, 'guarantor_id' => $guarantor->id]);
    }

    public function test_it_stamps_verifier_when_marked_verified(): void
    {
        $user = $this->actingUser();
        $invoiceGuarantor = InvoiceGuarantor::factory()->create();

        $response = $this->putJson("/api/v1/invoice-guarantors/{$invoiceGuarantor->id}", ['verification_status' => 'verified']);

        $response->assertOk();
        $this->assertDatabaseHas('invoice_guarantors', [
            'id' => $invoiceGuarantor->id,
            'verification_status' => 'verified',
            'verified_by' => $user->id,
        ]);
    }

    public function test_it_deletes_an_invoice_guarantor(): void
    {
        $this->actingUser();
        $invoiceGuarantor = InvoiceGuarantor::factory()->create();

        $this->deleteJson("/api/v1/invoice-guarantors/{$invoiceGuarantor->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_invoice_guarantors(): void
    {
        $this->getJson('/api/v1/invoice-guarantors')->assertStatus(401);
    }
}
