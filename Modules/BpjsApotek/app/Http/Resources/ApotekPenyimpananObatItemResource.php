<?php

namespace Modules\BpjsApotek\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApotekPenyimpananObatItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_obat' => $this->kode_obat,
            'nama_obat' => $this->nama_obat,
            'jumlah' => $this->jumlah,
        ];
    }
}
