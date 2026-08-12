<?php

namespace Modules\GeneralIcdOMorphology\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralIcdOMorphology\Models\IcdOMorphology;
use Tests\TestCase;

class IcdOMorphologyControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_icd_o_morphologies(): void
    {
        $this->actingUser();
        IcdOMorphology::factory()->count(3)->create();

        $this->getJson('/api/v1/icd-o-morphologies')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_icd_o_morphology(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/icd-o-morphologies', ['name' => 'Adenocarcinoma', 'code' => '8140/3'])
            ->assertCreated()
            ->assertJsonPath('name', 'Adenocarcinoma');

        $this->assertDatabaseHas('icd_o_morphologies', ['name' => 'Adenocarcinoma']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        IcdOMorphology::factory()->create(['name' => 'Adenocarcinoma']);

        $this->postJson('/api/v1/icd-o-morphologies', ['name' => 'Adenocarcinoma'])->assertStatus(422);
    }

    public function test_it_deletes_icd_o_morphology(): void
    {
        $this->actingUser();
        $morphology = IcdOMorphology::factory()->create();

        $this->deleteJson("/api/v1/icd-o-morphologies/{$morphology->id}")->assertStatus(204);
        $this->assertDatabaseMissing('icd_o_morphologies', ['id' => $morphology->id]);
    }
}
