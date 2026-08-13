<?php

namespace Modules\MedicalRecordDocumentUpload\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDocumentUpload\Models\DocumentUpload;
use Tests\TestCase;

class DocumentUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_document_upload(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/document-uploads', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'document_name' => 'Consent.pdf',
            'document_type' => 'Consent',
            'file_path' => 'uploads/consent.pdf',
            'file_size_bytes' => 50000,
        ]);

        $response->assertCreated()->assertJsonPath('data.document_name', 'Consent.pdf');
        $this->assertDatabaseHas('document_uploads', ['patient_id' => $patient->id]);
    }

    public function test_it_lists_document_uploads(): void
    {
        $this->actingUser();
        $upload = DocumentUpload::factory()->create();

        $response = $this->getJson('/api/v1/document-uploads');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($upload->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_document_upload(): void
    {
        $this->actingUser();
        $upload = DocumentUpload::factory()->create();

        $response = $this->getJson("/api/v1/document-uploads/{$upload->id}");

        $response->assertOk()->assertJsonPath('data.id', $upload->id);
    }

    public function test_it_updates_a_document_upload(): void
    {
        $this->actingUser();
        $upload = DocumentUpload::factory()->create();

        $response = $this->putJson("/api/v1/document-uploads/{$upload->id}", [
            'patient_id' => $upload->patient_id,
            'document_name' => $upload->document_name,
            'file_path' => $upload->file_path,
            'notes' => 'Updated notes',
        ]);

        $response->assertOk()->assertJsonPath('data.notes', 'Updated notes');
    }

    public function test_it_deletes_a_document_upload(): void
    {
        $this->actingUser();
        $upload = DocumentUpload::factory()->create();

        $response = $this->deleteJson("/api/v1/document-uploads/{$upload->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('document_uploads', ['id' => $upload->id]);
    }
}
