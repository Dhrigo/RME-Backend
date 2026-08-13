<?php

namespace Modules\GeneralScannedDocument\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralScannedDocument\Models\ScannedDocument;
use Tests\TestCase;

class GeneralScannedDocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_scanned_document(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/scanned-documents', [
            'patient_id' => $patient->id,
            'document_type' => 'ktp',
            'file_path' => 'scans/ktp-001.pdf',
            'scanned_at' => now()->toIso8601String(),
            'scanned_by' => $employee->id,
        ])
            ->assertCreated()
            ->assertJsonPath('data.document_type', 'ktp')
            ->assertJsonPath('data.file_path', 'scans/ktp-001.pdf');
    }

    public function test_it_creates_scanned_document_without_patient(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/scanned-documents', [
            'document_type' => 'surat_rujukan',
            'file_path' => 'scans/rujukan-001.pdf',
            'scanned_at' => now()->toIso8601String(),
            'scanned_by' => $employee->id,
        ])
            ->assertCreated()
            ->assertJsonPath('data.patient_id', null);
    }

    public function test_it_lists_scanned_documents_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        ScannedDocument::factory()->count(2)->create(['patient_id' => $patient->id]);
        ScannedDocument::factory()->create();

        $this->getJson("/api/v1/scanned-documents?patient_id={$patient->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/scanned-documents', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['document_type', 'file_path', 'scanned_at', 'scanned_by']);
    }

    public function test_it_shows_scanned_document(): void
    {
        $this->actingUser();
        $document = ScannedDocument::factory()->create();

        $this->getJson("/api/v1/scanned-documents/{$document->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $document->id);
    }

    public function test_it_has_no_update_or_delete_route(): void
    {
        $this->actingUser();
        $document = ScannedDocument::factory()->create();

        $this->putJson("/api/v1/scanned-documents/{$document->id}", ['document_type' => 'x'])
            ->assertStatus(405);

        $this->deleteJson("/api/v1/scanned-documents/{$document->id}")
            ->assertStatus(405);
    }
}
