<?php

namespace Modules\LayananExaminationResultStatus\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananExaminationResultStatus\Models\ExaminationResultStatus;
use Tests\TestCase;

class ExaminationResultStatusControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/examination-result-statuses', [
            'visit_id' => $visitId->id,
            'examination_type' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('examination_result_statuses', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ExaminationResultStatus::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/examination-result-statuses');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ExaminationResultStatus::factory()->create();

        $this->getJson("/api/v1/examination-result-statuses/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ExaminationResultStatus::factory()->create();

        $this->deleteJson("/api/v1/examination-result-statuses/{$record->id}")->assertStatus(204);
    }
}
