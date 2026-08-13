<?php

namespace Modules\MedicalRecordImplementationChecklistItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordImplementationChecklistItem\Models\ImplementationChecklistItem;
use Tests\TestCase;

class ImplementationChecklistItemControllerTest extends TestCase
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


        $response = $this->postJson('/api/v1/implementation-checklist-items', [
            'name' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('implementation_checklist_items', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ImplementationChecklistItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/implementation-checklist-items');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ImplementationChecklistItem::factory()->create();

        $this->getJson("/api/v1/implementation-checklist-items/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ImplementationChecklistItem::factory()->create();

        $this->deleteJson("/api/v1/implementation-checklist-items/{$record->id}")->assertStatus(204);
    }
}
