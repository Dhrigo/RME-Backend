<?php

namespace Modules\PembayaranClaimInvoice\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class ClaimInvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_claim_invoice_with_auto_generated_number(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/claim-invoices', [
            'invoice_id' => $invoice->id,
            'claim_amount' => 2500000,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('CLM-'.now()->format('Y').'-', $response->json('data.claim_number'));
    }

    public function test_it_stamps_submission_time_when_marked_submitted(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create();

        $this->putJson("/api/v1/claim-invoices/{$claim->id}", ['status' => 'submitted'])
            ->assertOk()
            ->assertJsonPath('data.status', 'submitted');

        $this->assertNotNull($claim->fresh()->submitted_at);
    }

    public function test_it_deletes_a_claim_invoice(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create();

        $this->deleteJson("/api/v1/claim-invoices/{$claim->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_claim_invoices(): void
    {
        $this->getJson('/api/v1/claim-invoices')->assertStatus(401);
    }
}
