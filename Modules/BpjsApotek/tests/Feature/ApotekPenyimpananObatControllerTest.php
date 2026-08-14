<?php

namespace Modules\BpjsApotek\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsApotek\Models\ApotekPelayananObat;
use Tests\TestCase;

class ApotekPenyimpananObatControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_stores_a_non_racikan_drug_dispense(): void
    {
        $this->actingUser();
        $pelayanan = ApotekPelayananObat::factory()->create();

        Http::fake([
            '*/penyimpananobat/insert' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['noPelayananObat' => 'PO0001'],
            ]),
        ]);

        $response = $this->postJson('/api/v1/apotek/penyimpanan-obat', [
            'pelayanan_id' => $pelayanan->id,
            'jenis' => 'non_racikan',
            'kode_obat' => 'DGN12345',
            'nama_obat' => 'Amlodipine 10mg',
            'jumlah' => 30,
            'aturan_pakai' => '1x1',
            'jumlah_hari' => 30,
            'harga' => 1500,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'success')->assertJsonPath('data.jenis', 'non_racikan');
        $this->assertDatabaseHas('apotek_penyimpanan_obats', ['pelayanan_id' => $pelayanan->id, 'kode_obat' => 'DGN12345', 'status' => 'success']);
    }

    public function test_it_stores_a_racikan_drug_dispense_with_ingredient_items(): void
    {
        $this->actingUser();
        $pelayanan = ApotekPelayananObat::factory()->create();

        Http::fake([
            '*/penyimpananobat/insert' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['noPelayananObat' => 'PO0002'],
            ]),
        ]);

        $response = $this->postJson('/api/v1/apotek/penyimpanan-obat', [
            'pelayanan_id' => $pelayanan->id,
            'jenis' => 'racikan',
            'nama_racikan' => 'Puyer Batuk',
            'jumlah' => 10,
            'aturan_pakai' => '3x1',
            'jumlah_hari' => 3,
            'harga' => 500,
            'items' => [
                ['kode_obat' => 'DGN001', 'nama_obat' => 'Paracetamol', 'jumlah' => 5],
                ['kode_obat' => 'DGN002', 'nama_obat' => 'CTM', 'jumlah' => 5],
            ],
        ]);

        $response->assertCreated()->assertJsonPath('data.jenis', 'racikan')->assertJsonCount(2, 'data.items');
        $this->assertDatabaseCount('apotek_penyimpanan_obat_items', 2);
    }

    public function test_racikan_requires_items(): void
    {
        $this->actingUser();
        $pelayanan = ApotekPelayananObat::factory()->create();

        $this->postJson('/api/v1/apotek/penyimpanan-obat', [
            'pelayanan_id' => $pelayanan->id,
            'jenis' => 'racikan',
            'nama_racikan' => 'Puyer Batuk',
            'jumlah' => 10,
        ])->assertStatus(422);
    }

    public function test_it_pushes_stock_update_without_persisting_locally(): void
    {
        $this->actingUser();

        Http::fake([
            '*/penyimpananobat/updatestok' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => null,
            ]),
        ]);

        $this->postJson('/api/v1/apotek/penyimpanan-obat-stok', [
            'obat' => [['kode_obat' => 'DGN001', 'stok' => 100]],
        ])->assertOk()->assertJsonPath('metaData.code', '200');
    }
}
