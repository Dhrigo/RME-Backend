<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordClinicalNoteCoManagement\Models\ClinicalNoteCoManagement;
use Tests\TestCase;

class ClinicalNoteCoManagementControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $clinicalNoteId = ClinicalNote::factory()->create();
        $medicalDepartmentId = MedicalDepartment::factory()->create();
        $authorId = Employee::factory()->create();

        $response = $this->postJson('/api/v1/clinical-note-co-managements', [
            'clinical_note_id' => $clinicalNoteId->id,
            'medical_department_id' => $medicalDepartmentId->id,
            'author_id' => $authorId->id,
            'recorded_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('clinical_note_co_managements', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ClinicalNoteCoManagement::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/clinical-note-co-managements');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ClinicalNoteCoManagement::factory()->create();

        $this->getJson("/api/v1/clinical-note-co-managements/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ClinicalNoteCoManagement::factory()->create();

        $this->deleteJson("/api/v1/clinical-note-co-managements/{$record->id}")->assertStatus(204);
    }
}
