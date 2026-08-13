<?php

namespace Modules\MedicalRecordIcd9CmCode\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordIcd9CmCode\Models\Icd9CmCode;
use Tests\TestCase;

class Icd9CmCodeControllerTest extends TestCase
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


        $response = $this->postJson('/api/v1/icd9-cm-codes', [
            'code' => 'Test value',
            'description' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('icd9_cm_codes', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        Icd9CmCode::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/icd9-cm-codes');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = Icd9CmCode::factory()->create();

        $this->getJson("/api/v1/icd9-cm-codes/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = Icd9CmCode::factory()->create();

        $this->deleteJson("/api/v1/icd9-cm-codes/{$record->id}")->assertStatus(204);
    }
}
