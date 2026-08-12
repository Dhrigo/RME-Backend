<?php

namespace Modules\MedicalRecordClinicalNote\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ClinicalNoteControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_soap_note(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $author = Employee::factory()->create();

        $response = $this->postJson('/api/v1/clinical-notes', [
            'visit_id' => $visit->id,
            'author_id' => $author->id,
            'subjective' => 'Pasien mengeluh demam 2 hari',
            'objective' => 'Suhu 38.5C',
            'assessment' => 'Suspek dengue',
            'planning' => 'Rawat inap, cek darah lengkap',
        ]);

        $response->assertCreated()->assertJsonPath('data.assessment', 'Suspek dengue');
        $this->assertDatabaseHas('clinical_notes', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_notes_filtered_by_visit_ordered_latest_first(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $older = ClinicalNote::factory()->create(['visit_id' => $visit->id, 'recorded_at' => now()->subDay()]);
        $newer = ClinicalNote::factory()->create(['visit_id' => $visit->id, 'recorded_at' => now()]);
        ClinicalNote::factory()->create();

        $response = $this->getJson("/api/v1/clinical-notes?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
        $this->assertEquals($newer->id, $response->json('data.0.id'));
    }

    public function test_guest_cannot_access_clinical_notes(): void
    {
        $this->getJson('/api/v1/clinical-notes')->assertStatus(401);
    }
}
