<?php

namespace Modules\PembayaranPatientReceivable\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Tests\TestCase;

class PatientReceivableControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_patient_receivables(): void
    {
        $this->actingUser();
        PatientReceivable::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-receivables')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_patient_receivable_as_outstanding(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/patient-receivables', [
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 250000,
            'due_date' => now()->addDays(14)->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');

        $this->assertDatabaseHas('patient_receivables', ['invoice_id' => $invoice->id, 'patient_id' => $patient->id, 'status' => 'outstanding']);
    }

    public function test_it_updates_status_to_settled(): void
    {
        $this->actingUser();
        $receivable = PatientReceivable::factory()->create(['status' => 'outstanding']);

        $this->putJson("/api/v1/patient-receivables/{$receivable->id}", ['status' => 'settled'])
            ->assertOk()
            ->assertJsonPath('data.status', 'settled');
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $receivable = PatientReceivable::factory()->create();

        $this->putJson("/api/v1/patient-receivables/{$receivable->id}", ['status' => 'invalid'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_patient_receivables(): void
    {
        $this->getJson('/api/v1/patient-receivables')->assertStatus(401);
    }
}
