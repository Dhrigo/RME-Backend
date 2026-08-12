<?php

namespace Modules\GeneralProcedure\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralProcedure\Models\Procedure;
use Tests\TestCase;

class ProcedureControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        Procedure::factory()->count(3)->create();

        $this->getJson('/api/v1/procedures')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = Procedure::factory()->make()->toArray();
        $this->postJson('/api/v1/procedures', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = Procedure::factory()->create();
        $payload = Procedure::factory()->make()->toArray();
        $this->putJson("/api/v1/procedures/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = Procedure::factory()->create();
        $this->deleteJson("/api/v1/procedures/{$item->id}")->assertStatus(204);
    }
}
