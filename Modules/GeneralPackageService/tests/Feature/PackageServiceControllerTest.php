<?php

namespace Modules\GeneralPackageService\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPackageService\Models\PackageService;
use Tests\TestCase;

class PackageServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items(): void
    {
        $this->actingUser();
        PackageService::factory()->count(3)->create();

        $this->getJson('/api/v1/package-services')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item(): void
    {
        $this->actingUser();
        $payload = PackageService::factory()->make()->toArray();
        $this->postJson('/api/v1/package-services', $payload)->assertCreated();
    }

    public function test_it_updates_item(): void
    {
        $this->actingUser();
        $item = PackageService::factory()->create();
        $payload = PackageService::factory()->make()->toArray();
        $this->putJson("/api/v1/package-services/{$item->id}", $payload)->assertOk();
    }

    public function test_it_deletes_item(): void
    {
        $this->actingUser();
        $item = PackageService::factory()->create();
        $this->deleteJson("/api/v1/package-services/{$item->id}")->assertStatus(204);
    }
}
