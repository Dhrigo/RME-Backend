<?php

namespace Modules\PembayaranInvoiceSubsidy\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;
use Tests\TestCase;

class InvoiceSubsidyControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_invoice_subsidy(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/invoice-subsidies', [
            'invoice_id' => $invoice->id,
            'subsidy_source' => 'pemerintah_daerah',
            'subsidy_amount' => 500000,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
    }

    public function test_it_rejects_unknown_subsidy_source(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $this->postJson('/api/v1/invoice-subsidies', [
            'invoice_id' => $invoice->id,
            'subsidy_source' => 'not_a_valid_source',
            'subsidy_amount' => 500000,
        ])->assertStatus(422);
    }

    public function test_it_stamps_approver_when_approved(): void
    {
        $user = $this->actingUser();
        $subsidy = InvoiceSubsidy::factory()->create();

        $this->putJson("/api/v1/invoice-subsidies/{$subsidy->id}", ['status' => 'approved'])
            ->assertOk();

        $this->assertDatabaseHas('invoice_subsidies', [
            'id' => $subsidy->id,
            'status' => 'approved',
            'approved_by' => $user->id,
        ]);
    }

    public function test_it_deletes_an_invoice_subsidy(): void
    {
        $this->actingUser();
        $subsidy = InvoiceSubsidy::factory()->create();

        $this->deleteJson("/api/v1/invoice-subsidies/{$subsidy->id}")->assertStatus(204);
    }
}
