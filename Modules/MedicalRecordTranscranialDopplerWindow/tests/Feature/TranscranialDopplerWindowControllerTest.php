<?php

namespace Modules\MedicalRecordTranscranialDopplerWindow\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordTranscranialDopplerExamination\Models\TranscranialDopplerExamination;
use Modules\MedicalRecordTranscranialDopplerWindow\Models\TranscranialDopplerWindow;
use Tests\TestCase;

class TranscranialDopplerWindowControllerTest extends TestCase
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
        $parent = TranscranialDopplerExamination::factory()->create();

        $payload = [
            'transcranial_doppler_examination_id' => $parent->id,
            'window_site' => 'temporal',
        ];

        $response = $this->postJson('/api/v1/tcd-windows', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.window_site', 'temporal');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TranscranialDopplerWindow::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/tcd-windows');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = TranscranialDopplerWindow::factory()->create();

        $response = $this->getJson("/api/v1/tcd-windows/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = TranscranialDopplerWindow::factory()->create();

        $response = $this->putJson("/api/v1/tcd-windows/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = TranscranialDopplerWindow::factory()->create();

        $response = $this->deleteJson("/api/v1/tcd-windows/{$record->id}");

        $response->assertNoContent();
    }
}
