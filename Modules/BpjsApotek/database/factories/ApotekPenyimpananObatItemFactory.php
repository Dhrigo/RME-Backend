<?php

namespace Modules\BpjsApotek\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsApotek\Models\ApotekPenyimpananObat;
use Modules\BpjsApotek\Models\ApotekPenyimpananObatItem;

class ApotekPenyimpananObatItemFactory extends Factory
{
    protected $model = ApotekPenyimpananObatItem::class;

    public function definition(): array
    {
        return [
            'penyimpanan_obat_id' => ApotekPenyimpananObat::factory()->racikan(),
            'kode_obat' => fake()->numerify('DGN#####'),
            'nama_obat' => fake()->words(2, true),
            'jumlah' => 1,
        ];
    }
}
