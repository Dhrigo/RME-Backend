<?php

namespace Modules\MedicalRecordCatClamsExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordCatClamsExamination\Models\CatClamsExamination;
use Tests\TestCase;

class CatClamsExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_cat_clams_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 14,
            'patient_id' => 28,
            'cat_score' => 90.0,
            'clams_score' => 95.0,
            'developmental_quotient' => 92.5,
            'developmental_age_months' => 30.0,
        ];

        $response = $this->postJson('/api/v1/cat-clams-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.cat_score', 90)
            ->assertJsonPath('data.clams_score', 95);

        $this->assertDatabaseHas('cat_clams_examinations', ['visit_id' => 14, 'patient_id' => 28]);
    }

    public function test_it_lists_cat_clams_examinations(): void
    {
        $this->actingUser();
        CatClamsExamination::factory()->count(2)->create(['visit_id' => 14]);

        $response = $this->getJson('/api/v1/cat-clams-examinations?visit_id=14');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_cat_clams_examination(): void
    {
        $this->actingUser();
        $record = CatClamsExamination::factory()->create();

        $response = $this->getJson("/api/v1/cat-clams-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_cat_clams_examination(): void
    {
        $this->actingUser();
        $record = CatClamsExamination::factory()->create();

        $response = $this->putJson("/api/v1/cat-clams-examinations/{$record->id}", [
            'interpretation' => 'Advanced development',
        ]);

        $response->assertOk()->assertJsonPath('data.interpretation', 'Advanced development');
    }

    public function test_it_deletes_a_cat_clams_examination(): void
    {
        $this->actingUser();
        $record = CatClamsExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/cat-clams-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('cat_clams_examinations', ['id' => $record->id]);
    }
}
