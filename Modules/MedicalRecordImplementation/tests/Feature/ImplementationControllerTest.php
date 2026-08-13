<?php

namespace Modules\MedicalRecordImplementation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImplementation\Models\Implementation;
use Tests\TestCase;

class ImplementationControllerTest extends TestCase
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
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/implementations', [
            'visit_id' => $visitId->id,
            'performed_by' => $performedBy->id,
            'performed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('implementations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        Implementation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/implementations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = Implementation::factory()->create();

        $this->getJson("/api/v1/implementations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = Implementation::factory()->create();

        $this->deleteJson("/api/v1/implementations/{$record->id}")->assertStatus(204);
    }
}
