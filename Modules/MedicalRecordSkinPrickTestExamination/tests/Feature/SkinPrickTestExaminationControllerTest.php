<?php

namespace Modules\MedicalRecordSkinPrickTestExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordSkinPrickTestExamination\Models\SkinPrickTestExamination;
use Tests\TestCase;

class SkinPrickTestExaminationControllerTest extends TestCase
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
            'visit_id' => 1,
            'allergen' => 'House dust mite',
        ];

        $response = $this->postJson('/api/v1/skin-prick-tests', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.allergen', 'House dust mite');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        SkinPrickTestExamination::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/skin-prick-tests');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = SkinPrickTestExamination::factory()->create();

        $response = $this->getJson("/api/v1/skin-prick-tests/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = SkinPrickTestExamination::factory()->create();

        $response = $this->putJson("/api/v1/skin-prick-tests/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = SkinPrickTestExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/skin-prick-tests/{$record->id}");

        $response->assertNoContent();
    }
}
