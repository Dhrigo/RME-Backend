<?php

namespace Modules\GeneralEducation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEducation\Models\Education;
use Tests\TestCase;

class EducationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_educations(): void
    {
        $this->actingUser();
        Education::factory()->count(2)->create();

        $this->getJson('/api/v1/educations')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_creates_education(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/educations', ['name' => 'Sample'])
            ->assertCreated()
            ->assertJsonPath('name', 'Sample');
    }

    public function test_it_deletes_education(): void
    {
        $this->actingUser();
        $item = Education::factory()->create();

        $this->deleteJson("/api/v1/educations/{$item->id}")->assertStatus(204);
    }
}
