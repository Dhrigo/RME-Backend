<?php

namespace Modules\PembayaranPackageInvoiceItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPackage\Models\Package;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPackageInvoiceItem\Models\PackageInvoiceItem;
use Tests\TestCase;

class PackageInvoiceItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items_for_an_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        PackageInvoiceItem::factory()->count(2)->create(['invoice_id' => $invoice->id]);
        PackageInvoiceItem::factory()->create();

        $this->getJson("/api/v1/package-invoice-items?invoice_id={$invoice->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_computes_subtotal_from_quantity_and_unit_price(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $package = Package::factory()->create();

        $response = $this->postJson('/api/v1/package-invoice-items', [
            'invoice_id' => $invoice->id,
            'package_id' => $package->id,
            'quantity' => 2,
            'unit_price' => 300000,
        ]);

        $response->assertCreated();
        $this->assertEquals(600000, $response->json('data.subtotal'));
    }

    public function test_it_deletes_an_item(): void
    {
        $this->actingUser();
        $item = PackageInvoiceItem::factory()->create();

        $this->deleteJson("/api/v1/package-invoice-items/{$item->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_package_invoice_items(): void
    {
        $this->getJson('/api/v1/package-invoice-items')->assertStatus(401);
    }
}
