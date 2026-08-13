<?php

namespace Modules\GeneralExaminationGroup\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralExaminationGroup\Models\ExaminationGroup;
use Tests\TestCase;

class ExaminationGroupControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_examination_groups(): void
    {
        $this->actingUser();
        ExaminationGroup::factory()->count(3)->create();

        $this->getJson('/api/v1/examination-groups')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_examination_group(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/examination-groups', ['name' => 'Radiologi', 'code' => 'RAD'])
            ->assertCreated()
            ->assertJsonPath('name', 'Radiologi');

        $this->assertDatabaseHas('examination_groups', ['name' => 'Radiologi']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        ExaminationGroup::factory()->create(['name' => 'Radiologi']);

        $this->postJson('/api/v1/examination-groups', ['name' => 'Radiologi'])->assertStatus(422);
    }

    public function test_it_deletes_examination_group(): void
    {
        $this->actingUser();
        $examinationGroup = ExaminationGroup::factory()->create();

        $this->deleteJson("/api/v1/examination-groups/{$examinationGroup->id}")->assertStatus(204);
        $this->assertDatabaseMissing('examination_groups', ['id' => $examinationGroup->id]);
    }
}
