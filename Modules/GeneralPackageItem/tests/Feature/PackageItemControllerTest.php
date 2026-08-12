<?php

namespace Modules\GeneralPackageItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPackageItem\Models\PackageItem;
use Tests\TestCase;

class PackageItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        PackageItem::factory()->count(3)->create();

        $this->getJson('/api/v1/package-items')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = PackageItem::factory()->make()->toArray();
        $this->postJson('/api/v1/package-items', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = PackageItem::factory()->create();
        $payload = PackageItem::factory()->make()->toArray();
        $this->putJson("/api/v1/package-items/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = PackageItem::factory()->create();
        $this->deleteJson("/api/v1/package-items/{$item->id}")->assertStatus(204);
    }
}
