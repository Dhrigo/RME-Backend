<?php

namespace Modules\MedicalRecordExaminationType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordExaminationType\Models\ExaminationType;
use Tests\TestCase;

class ExaminationTypeControllerTest extends TestCase
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


        $response = $this->postJson('/api/v1/examination-types', [
            'name' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('examination_types', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ExaminationType::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/examination-types');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ExaminationType::factory()->create();

        $this->getJson("/api/v1/examination-types/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ExaminationType::factory()->create();

        $this->deleteJson("/api/v1/examination-types/{$record->id}")->assertStatus(204);
    }
}
