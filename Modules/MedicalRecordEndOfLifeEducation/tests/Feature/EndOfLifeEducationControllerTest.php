<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEndOfLifeEducation\Models\EndOfLifeEducation;
use Tests\TestCase;

class EndOfLifeEducationControllerTest extends TestCase
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
        $visitId = Visit::factory()->create();
        $educatorId = Employee::factory()->create();

        $response = $this->postJson('/api/v1/end-of-life-educations', [
            'visit_id' => $visitId->id,
            'topic' => 'Test value',
            'educator_id' => $educatorId->id,
            'educated_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('end_of_life_educations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        EndOfLifeEducation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/end-of-life-educations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = EndOfLifeEducation::factory()->create();

        $this->getJson("/api/v1/end-of-life-educations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = EndOfLifeEducation::factory()->create();

        $this->deleteJson("/api/v1/end-of-life-educations/{$record->id}")->assertStatus(204);
    }
}
