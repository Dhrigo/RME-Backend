<?php

namespace Modules\PembayaranInvoiceItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;
use Tests\TestCase;

class InvoiceItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_adds_item_and_recalculates_invoice_total(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $this->postJson('/api/v1/invoice-items', [
            'invoice_id' => $invoice->id,
            'description' => 'Konsultasi Dokter',
            'quantity' => 2,
            'unit_price' => 50000,
        ])->assertCreated()->assertJsonPath('data.subtotal', '100000.00');

        $this->assertEquals(100000, $invoice->fresh()->total_amount);
    }

    public function test_it_cannot_add_item_to_locked_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->locked()->create();

        $this->postJson('/api/v1/invoice-items', [
            'invoice_id' => $invoice->id,
            'description' => 'Obat',
            'quantity' => 1,
            'unit_price' => 10000,
        ])->assertStatus(422);
    }

    public function test_it_removes_item_and_recalculates_total(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $item = InvoiceItem::factory()->create(['invoice_id' => $invoice->id, 'quantity' => 1, 'unit_price' => 75000, 'subtotal' => 75000]);
        $invoice->recalculateTotals();

        $this->deleteJson("/api/v1/invoice-items/{$item->id}")->assertStatus(204);

        $this->assertEquals(0, $invoice->fresh()->total_amount);
    }
}
