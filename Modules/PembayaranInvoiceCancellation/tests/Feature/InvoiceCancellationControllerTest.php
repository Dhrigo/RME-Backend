<?php

namespace Modules\PembayaranInvoiceCancellation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceCancellation\Models\InvoiceCancellation;
use Tests\TestCase;

class InvoiceCancellationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_invoice_cancellations(): void
    {
        $this->actingUser();
        InvoiceCancellation::factory()->count(3)->create();

        $this->getJson('/api/v1/invoice-cancellations')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_cancellation_and_locks_invoice(): void
    {
        $user = $this->actingUser();
        $invoice = Invoice::factory()->create(['status' => 'open', 'is_locked' => false]);

        $this->postJson('/api/v1/invoice-cancellations', [
            'invoice_id' => $invoice->id,
            'reason' => 'Salah input pasien',
        ])->assertCreated()->assertJsonPath('data.cancelled_by', $user->id);

        $this->assertDatabaseHas('invoice_cancellations', ['invoice_id' => $invoice->id, 'cancelled_by' => $user->id]);
        $this->assertEquals('cancelled', $invoice->fresh()->status);
        $this->assertTrue((bool) $invoice->fresh()->is_locked);
    }

    public function test_it_requires_reason(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $this->postJson('/api/v1/invoice-cancellations', ['invoice_id' => $invoice->id])
            ->assertStatus(422);
    }

    public function test_it_has_no_update_or_delete_routes(): void
    {
        $this->actingUser();
        $cancellation = InvoiceCancellation::factory()->create();

        $this->putJson("/api/v1/invoice-cancellations/{$cancellation->id}", ['reason' => 'x'])->assertStatus(405);
        $this->deleteJson("/api/v1/invoice-cancellations/{$cancellation->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_invoice_cancellations(): void
    {
        $this->getJson('/api/v1/invoice-cancellations')->assertStatus(401);
    }
}
