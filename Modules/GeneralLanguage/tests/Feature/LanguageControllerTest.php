<?php

namespace Modules\GeneralLanguage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralLanguage\Models\Language;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_languages(): void
    {
        $this->actingUser();
        Language::factory()->count(2)->create();

        $this->getJson('/api/v1/languages')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_creates_language(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/languages', ['name' => 'Sample'])
            ->assertCreated()
            ->assertJsonPath('name', 'Sample');
    }

    public function test_it_deletes_language(): void
    {
        $this->actingUser();
        $item = Language::factory()->create();

        $this->deleteJson("/api/v1/languages/{$item->id}")->assertStatus(204);
    }
}
