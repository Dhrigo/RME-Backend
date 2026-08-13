<?php

namespace Modules\PembayaranCorporateReceivable\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class CorporateReceivableControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_corporate_receivables(): void
    {
        $this->actingUser();
        CorporateReceivable::factory()->count(3)->create();

        $this->getJson('/api/v1/corporate-receivables')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_corporate_receivable_as_outstanding(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/corporate-receivables', [
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'amount' => 1500000,
            'due_date' => now()->addDays(30)->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');

        $this->assertDatabaseHas('corporate_receivables', ['invoice_id' => $invoice->id, 'guarantor_id' => $guarantor->id]);
    }

    public function test_it_updates_status_to_settled(): void
    {
        $this->actingUser();
        $receivable = CorporateReceivable::factory()->create(['status' => 'outstanding']);

        $this->putJson("/api/v1/corporate-receivables/{$receivable->id}", ['status' => 'settled'])
            ->assertOk()
            ->assertJsonPath('data.status', 'settled');
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $receivable = CorporateReceivable::factory()->create();

        $this->putJson("/api/v1/corporate-receivables/{$receivable->id}", ['status' => 'invalid'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_corporate_receivables(): void
    {
        $this->getJson('/api/v1/corporate-receivables')->assertStatus(401);
    }
}
