<?php

namespace Modules\GeneralExaminationGroupMapping\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralExaminationGroup\Models\ExaminationGroup;
use Modules\GeneralExaminationGroupMapping\Models\ExaminationGroupMapping;
use Tests\TestCase;

class ExaminationGroupMappingControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_mappings(): void
    {
        $this->actingUser();
        ExaminationGroupMapping::factory()->count(3)->create();

        $this->getJson('/api/v1/examination-group-mappings')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_mapping(): void
    {
        $this->actingUser();
        $group = ExaminationGroup::factory()->create();

        $this->postJson('/api/v1/examination-group-mappings', [
            'examination_group_id' => $group->id,
            'mapping_category' => 'Laboratorium',
        ])->assertCreated()->assertJsonPath('data.mapping_category', 'Laboratorium');

        $this->assertDatabaseHas('examination_group_mappings', ['examination_group_id' => $group->id, 'mapping_category' => 'Laboratorium']);
    }

    public function test_it_rejects_unknown_examination_group(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/examination-group-mappings', [
            'examination_group_id' => 99999,
            'mapping_category' => 'Laboratorium',
        ])->assertStatus(422);
    }

    public function test_it_updates_mapping(): void
    {
        $this->actingUser();
        $mapping = ExaminationGroupMapping::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/examination-group-mappings/{$mapping->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_mapping(): void
    {
        $this->actingUser();
        $mapping = ExaminationGroupMapping::factory()->create();

        $this->deleteJson("/api/v1/examination-group-mappings/{$mapping->id}")->assertStatus(204);
        $this->assertDatabaseMissing('examination_group_mappings', ['id' => $mapping->id]);
    }
}
