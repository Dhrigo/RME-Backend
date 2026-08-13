<?php

namespace Modules\MedicalRecordIcd10Code\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordIcd10Code\Models\Icd10Code;
use Tests\TestCase;

class Icd10CodeControllerTest extends TestCase
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


        $response = $this->postJson('/api/v1/icd10-codes', [
            'code' => 'Test value',
            'description' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('icd10_codes', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        Icd10Code::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/icd10-codes');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = Icd10Code::factory()->create();

        $this->getJson("/api/v1/icd10-codes/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = Icd10Code::factory()->create();

        $this->deleteJson("/api/v1/icd10-codes/{$record->id}")->assertStatus(204);
    }
}
