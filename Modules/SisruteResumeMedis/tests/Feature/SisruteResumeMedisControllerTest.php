<?php

namespace Modules\SisruteResumeMedis\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class SisruteResumeMedisControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_sends_a_resume_medis_and_records_local_status(): void
    {
        Http::fake(['*' => Http::response(['success' => true])]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/sisrute-resume-medis/resume', ['no_rm' => '0001234567']);

        $response->assertCreated();
        $this->assertSame('sent', $response->json('status'));
    }

    public function test_it_reads_resume_medis_list(): void
    {
        Http::fake(['*' => Http::response(['data' => []])]);

        $this->actingUser();

        $response = $this->getJson('/api/v1/sisrute-resume-medis/resume');

        $response->assertOk();
    }
}
