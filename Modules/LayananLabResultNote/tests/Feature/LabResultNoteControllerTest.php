<?php

namespace Modules\LayananLabResultNote\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabResultNote\Models\LabResultNote;
use Tests\TestCase;

class LabResultNoteControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_lab_notes(): void
    {
        $this->actingUser();
        LabResultNote::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-result-notes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lab_note(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-result-notes', [
            'lab_result_id' => \Modules\LayananLabResult\Models\LabResult::factory()->create()->id,
            'note' => 'Test description text',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_result_notes', 1);
    }

    public function test_it_deletes_lab_note(): void
    {
        $this->actingUser();
        $lab_note = LabResultNote::factory()->create();

        $this->deleteJson("/api/v1/lab-result-notes/{$lab_note->id}")->assertStatus(204);
        $this->assertDatabaseMissing('lab_result_notes', ['id' => $lab_note->id]);
    }

    public function test_it_shows_lab_note(): void
    {
        $this->actingUser();
        $lab_note = LabResultNote::factory()->create();

        $this->getJson("/api/v1/lab-result-notes/{$lab_note->id}")->assertOk()->assertJsonPath('data.id', $lab_note->id);
    }

}
