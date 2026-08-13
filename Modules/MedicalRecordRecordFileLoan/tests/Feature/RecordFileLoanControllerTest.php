<?php

namespace Modules\MedicalRecordRecordFileLoan\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan;
use Tests\TestCase;

class RecordFileLoanControllerTest extends TestCase
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

        $payload = [
            'patient_id' => 1,
            'borrower_name' => 'Dr. Ahmad Setiawan',
            'loaned_at' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/record-file-loans', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.borrower_name', 'Dr. Ahmad Setiawan');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        RecordFileLoan::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/record-file-loans');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create();

        $response = $this->getJson("/api/v1/record-file-loans/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create();

        $response = $this->putJson("/api/v1/record-file-loans/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create();

        $response = $this->deleteJson("/api/v1/record-file-loans/{$record->id}");

        $response->assertNoContent();
    }
}
