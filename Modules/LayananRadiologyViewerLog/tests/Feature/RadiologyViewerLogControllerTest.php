<?php

namespace Modules\LayananRadiologyViewerLog\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananRadiologyViewerLog\Models\RadiologyViewerLog;
use Tests\TestCase;

class RadiologyViewerLogControllerTest extends TestCase
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
        $viewedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/radiology-viewer-logs', [
            'visit_id' => $visitId->id,
            'viewed_by' => $viewedBy->id,
            'viewed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('radiology_viewer_logs', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        RadiologyViewerLog::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/radiology-viewer-logs');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = RadiologyViewerLog::factory()->create();

        $this->getJson("/api/v1/radiology-viewer-logs/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = RadiologyViewerLog::factory()->create();

        $this->deleteJson("/api/v1/radiology-viewer-logs/{$record->id}")->assertStatus(204);
    }
}
