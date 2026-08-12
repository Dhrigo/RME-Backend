<?php

namespace Modules\PembayaranInvoice\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_invoice_with_auto_generated_number(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/invoices', ['visit_id' => $visit->id]);

        $response->assertCreated();
        $this->assertStringStartsWith('INV-'.now()->format('Y').'-', $response->json('data.invoice_number'));
    }

    public function test_it_cannot_update_a_locked_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->locked()->create();

        $this->putJson("/api/v1/invoices/{$invoice->id}", ['status' => 'cancelled'])
            ->assertStatus(422);
    }

    public function test_it_cannot_delete_a_locked_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->locked()->create();

        $this->deleteJson("/api/v1/invoices/{$invoice->id}")->assertStatus(422);
    }
}
