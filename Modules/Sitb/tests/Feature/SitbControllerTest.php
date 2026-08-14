<?php

namespace Modules\Sitb\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\Sitb\Models\PasienTb;
use Tests\TestCase;

class SitbControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pasien_tb_row_and_sends_it_with_transformed_fields(): void
    {
        Http::fake(['*' => Http::response(['status' => 'berhasil', 'id_tb_03' => 'TB03-1'])]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/sitb/pasien-tb', [
            'nourut_pasien' => '1234567890',
            'nik' => '3201010101010001',
            'jenis_kelamin' => 1,
            'tgl_lahir' => '1990-05-17',
            'klasifikasi_lokasi_anatomi' => 0,
        ]);

        $response->assertCreated();
        $this->assertSame(0, $response->json('kirim'));
        $this->assertSame('TB03-1', $response->json('id_tb_03'));

        Http::assertSent(function ($request) {
            return $request['jenis_kelamin'] === 'L'
                && $request['tgl_lahir'] === '19900517'
                && ! array_key_exists('klasifikasi_lokasi_anatomi', $request->data());
        });
    }

    public function test_it_keeps_kirim_flag_set_when_sitb_rejects(): void
    {
        Http::fake(['*' => Http::response(['status' => 'gagal', 'keterangan' => 'NIK invalid'])]);

        $this->actingUser();
        $pasienTb = PasienTb::factory()->create();

        $response = $this->putJson("/api/v1/sitb/pasien-tb/{$pasienTb->id}", [
            'nourut_pasien' => $pasienTb->nourut_pasien,
        ]);

        $response->assertOk();
        $this->assertSame(1, $response->json('kirim'));
        $this->assertSame('NIK invalid', $response->json('error_message'));
    }
}
