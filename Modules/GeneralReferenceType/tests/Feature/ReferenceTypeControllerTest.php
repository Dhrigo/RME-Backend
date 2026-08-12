<?php

namespace Modules\GeneralReferenceType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralReferenceType\Models\ReferenceType;
use Tests\TestCase;

class ReferenceTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_reference_types(): void
    {
        $this->actingUser();
        ReferenceType::factory()->count(3)->create();

        $this->getJson('/api/v1/reference-types')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_reference_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/reference-types', ['name' => 'Agama', 'abbreviation' => 'AGM'])
            ->assertCreated()
            ->assertJsonPath('name', 'Agama');

        $this->assertDatabaseHas('reference_types', ['name' => 'Agama']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        ReferenceType::factory()->create(['name' => 'Agama']);

        $this->postJson('/api/v1/reference-types', ['name' => 'Agama', 'abbreviation' => 'AGM'])->assertStatus(422);
    }

    public function test_it_deletes_reference_type(): void
    {
        $this->actingUser();
        $referenceType = ReferenceType::factory()->create();

        $this->deleteJson("/api/v1/reference-types/{$referenceType->id}")->assertStatus(204);
        $this->assertDatabaseMissing('reference_types', ['id' => $referenceType->id]);
    }
}
