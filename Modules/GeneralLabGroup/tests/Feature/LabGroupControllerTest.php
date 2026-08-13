<?php

namespace Modules\GeneralLabGroup\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralLabGroup\Models\LabGroup;
use Tests\TestCase;

class LabGroupControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_lab_groups(): void
    {
        $this->actingUser();
        LabGroup::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-groups')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lab_group(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-groups', ['name' => 'Hematologi', 'code' => 'HEM'])
            ->assertCreated()
            ->assertJsonPath('name', 'Hematologi');

        $this->assertDatabaseHas('lab_groups', ['name' => 'Hematologi']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        LabGroup::factory()->create(['name' => 'Hematologi']);

        $this->postJson('/api/v1/lab-groups', ['name' => 'Hematologi'])->assertStatus(422);
    }

    public function test_it_deletes_lab_group(): void
    {
        $this->actingUser();
        $labGroup = LabGroup::factory()->create();

        $this->deleteJson("/api/v1/lab-groups/{$labGroup->id}")->assertStatus(204);
        $this->assertDatabaseMissing('lab_groups', ['id' => $labGroup->id]);
    }
}
