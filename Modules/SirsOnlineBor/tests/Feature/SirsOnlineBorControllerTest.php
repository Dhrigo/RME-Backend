<?php

namespace Modules\SirsOnlineBor\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class SirsOnlineBorControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_tempat_tidur_row_and_pushes_it(): void
    {
        Http::fake(['*' => Http::response(['success' => true])]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/sirs-online-bor/tempat-tidur', [
            'id_tt' => 'TT-001',
            'ruang' => 'ICU',
            'jumlah' => 10,
            'terpakai' => 3,
        ]);

        $response->assertCreated();
        $this->assertSame('sent', $response->json('status'));
        $this->assertSame('ICU', $response->json('ruang'));
    }

    public function test_it_deletes_using_id_t_tt_query_param(): void
    {
        Http::fake(['*' => Http::response(['success' => true])]);

        $this->actingUser();
        $tempatTidur = \Modules\SirsOnlineBor\Models\TempatTidur::factory()->create();

        $response = $this->deleteJson("/api/v1/sirs-online-bor/tempat-tidur/{$tempatTidur->id}");

        $response->assertOk();
        Http::assertSent(fn ($request) => $request['id_t_tt'] === $tempatTidur->id_tt);
    }
}
