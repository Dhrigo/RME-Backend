<?php

namespace Modules\MedicalRecordObstetrics\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordObstetrics\Models\Obstetrics;
use Tests\TestCase;

class ObstetricsControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_obstetrics_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 5,
            'patient_id' => 12,
            'gravida' => 2,
            'para' => 1,
            'abortus' => 0,
            'gestational_age_weeks' => 38.5,
            'fundal_height_cm' => 32.0,
            'fetal_heart_rate' => 144,
            'fetal_presentation' => 'Cephalic',
        ];

        $response = $this->postJson('/api/v1/obstetrics-records', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 5)
            ->assertJsonPath('data.fetal_heart_rate', 144);

        $this->assertDatabaseHas('obstetrics_records', ['visit_id' => 5, 'patient_id' => 12]);
    }

    public function test_it_lists_obstetrics_records(): void
    {
        $this->actingUser();
        Obstetrics::factory()->count(2)->create(['visit_id' => 5]);

        $response = $this->getJson('/api/v1/obstetrics-records?visit_id=5');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_obstetrics_record(): void
    {
        $this->actingUser();
        $record = Obstetrics::factory()->create();

        $response = $this->getJson("/api/v1/obstetrics-records/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_obstetrics_record(): void
    {
        $this->actingUser();
        $record = Obstetrics::factory()->create();

        $response = $this->putJson("/api/v1/obstetrics-records/{$record->id}", [
            'fetal_heart_rate' => 150,
        ]);

        $response->assertOk()->assertJsonPath('data.fetal_heart_rate', 150);
    }

    public function test_it_deletes_an_obstetrics_record(): void
    {
        $this->actingUser();
        $record = Obstetrics::factory()->create();

        $response = $this->deleteJson("/api/v1/obstetrics-records/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('obstetrics_records', ['id' => $record->id]);
    }
}
