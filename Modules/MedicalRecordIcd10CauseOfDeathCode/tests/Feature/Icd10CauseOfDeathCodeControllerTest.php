<?php

namespace Modules\MedicalRecordIcd10CauseOfDeathCode\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Models\Icd10CauseOfDeathCode;
use Tests\TestCase;

class Icd10CauseOfDeathCodeControllerTest extends TestCase
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


        $response = $this->postJson('/api/v1/icd10-cause-of-death-codes', [
            'code' => 'Test value',
            'description' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('icd10_cause_of_death_codes', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        Icd10CauseOfDeathCode::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/icd10-cause-of-death-codes');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = Icd10CauseOfDeathCode::factory()->create();

        $this->getJson("/api/v1/icd10-cause-of-death-codes/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = Icd10CauseOfDeathCode::factory()->create();

        $this->deleteJson("/api/v1/icd10-cause-of-death-codes/{$record->id}")->assertStatus(204);
    }
}
