<?php

namespace Modules\PembayaranRegistrationInvoice\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranRegistrationInvoice\Models\RegistrationInvoice;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class RegistrationInvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_a_registration_invoice(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/registration-invoices', [
            'registration_id' => $registration->id,
            'invoice_id' => $invoice->id,
            'invoice_category' => 'registration_fee',
            'amount' => 50000,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('registration_invoices', ['registration_id' => $registration->id, 'invoice_id' => $invoice->id]);
    }

    public function test_it_lists_invoices_for_a_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        RegistrationInvoice::factory()->count(2)->create(['registration_id' => $registration->id]);
        RegistrationInvoice::factory()->create();

        $this->getJson("/api/v1/registration-invoices?registration_id={$registration->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_deletes_a_registration_invoice(): void
    {
        $this->actingUser();
        $item = RegistrationInvoice::factory()->create();

        $this->deleteJson("/api/v1/registration-invoices/{$item->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_registration_invoices(): void
    {
        $this->getJson('/api/v1/registration-invoices')->assertStatus(401);
    }
}
