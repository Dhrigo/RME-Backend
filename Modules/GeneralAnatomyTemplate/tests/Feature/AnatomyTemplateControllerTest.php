<?php

namespace Modules\GeneralAnatomyTemplate\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAnatomyTemplate\Models\AnatomyTemplate;
use Tests\TestCase;

class AnatomyTemplateControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        AnatomyTemplate::factory()->count(3)->create();

        $this->getJson('/api/v1/anatomy-templates')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = AnatomyTemplate::factory()->make()->toArray();
        $this->postJson('/api/v1/anatomy-templates', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = AnatomyTemplate::factory()->create();
        $payload = AnatomyTemplate::factory()->make()->toArray();
        $this->putJson("/api/v1/anatomy-templates/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = AnatomyTemplate::factory()->create();
        $this->deleteJson("/api/v1/anatomy-templates/{$item->id}")->assertStatus(204);
    }
}
