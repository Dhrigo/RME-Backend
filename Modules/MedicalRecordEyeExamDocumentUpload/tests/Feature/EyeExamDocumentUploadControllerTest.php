<?php

namespace Modules\MedicalRecordEyeExamDocumentUpload\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordEyeExamDocumentUpload\Models\EyeExamDocumentUpload;
use Tests\TestCase;

class EyeExamDocumentUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_eye_exam_document_upload(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/eye-exam-document-uploads', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'exam_date' => '2026-08-13 14:00:00',
            'file_path' => 'eye_exams/left_eye.jpg',
            'eye_side' => 'Left',
            'findings' => 'Clear cornea',
        ]);

        $response->assertCreated()->assertJsonPath('data.eye_side', 'Left');
        $this->assertDatabaseHas('eye_exam_document_uploads', ['patient_id' => $patient->id]);
    }

    public function test_it_lists_eye_exam_document_uploads(): void
    {
        $this->actingUser();
        $upload = EyeExamDocumentUpload::factory()->create();

        $response = $this->getJson('/api/v1/eye-exam-document-uploads');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($upload->id, $response->json('data.0.id'));
    }

    public function test_it_shows_an_eye_exam_document_upload(): void
    {
        $this->actingUser();
        $upload = EyeExamDocumentUpload::factory()->create();

        $response = $this->getJson("/api/v1/eye-exam-document-uploads/{$upload->id}");

        $response->assertOk()->assertJsonPath('data.id', $upload->id);
    }

    public function test_it_updates_an_eye_exam_document_upload(): void
    {
        $this->actingUser();
        $upload = EyeExamDocumentUpload::factory()->create();

        $response = $this->putJson("/api/v1/eye-exam-document-uploads/{$upload->id}", [
            'patient_id' => $upload->patient_id,
            'visit_id' => $upload->visit_id,
            'exam_date' => $upload->exam_date->toDateTimeString(),
            'file_path' => $upload->file_path,
            'findings' => 'Updated findings',
        ]);

        $response->assertOk()->assertJsonPath('data.findings', 'Updated findings');
    }

    public function test_it_deletes_an_eye_exam_document_upload(): void
    {
        $this->actingUser();
        $upload = EyeExamDocumentUpload::factory()->create();

        $response = $this->deleteJson("/api/v1/eye-exam-document-uploads/{$upload->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('eye_exam_document_uploads', ['id' => $upload->id]);
    }
}
