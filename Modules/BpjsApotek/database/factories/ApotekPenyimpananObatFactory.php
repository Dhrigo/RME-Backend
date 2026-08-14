<?php

namespace Modules\BpjsApotek\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsApotek\Models\ApotekPelayananObat;
use Modules\BpjsApotek\Models\ApotekPenyimpananObat;

class ApotekPenyimpananObatFactory extends Factory
{
    protected $model = ApotekPenyimpananObat::class;

    public function definition(): array
    {
        return [
            'pelayanan_id' => ApotekPelayananObat::factory(),
            'jenis' => 'non_racikan',
            'kode_obat' => fake()->numerify('DGN#####'),
            'nama_obat' => fake()->words(2, true),
            'nama_racikan' => null,
            'jumlah' => 10,
            'aturan_pakai' => '3x1',
            'signa1' => 3,
            'signa2' => 1,
            'jumlah_hari' => 10,
            'harga' => 5000,
            'bpjs_no_pelayanan_obat' => null,
            'status' => 'draft',
            'bpjs_message' => null,
            'submitted_at' => null,
        ];
    }

    public function racikan(): static
    {
        return $this->state(fn () => [
            'jenis' => 'racikan',
            'kode_obat' => null,
            'nama_obat' => null,
            'nama_racikan' => 'Puyer Batuk',
        ]);
    }
}
