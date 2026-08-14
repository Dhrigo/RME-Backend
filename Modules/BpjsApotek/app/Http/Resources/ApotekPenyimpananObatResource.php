<?php

namespace Modules\BpjsApotek\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApotekPenyimpananObatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pelayanan_id' => $this->pelayanan_id,
            'jenis' => $this->jenis,
            'kode_obat' => $this->kode_obat,
            'nama_obat' => $this->nama_obat,
            'nama_racikan' => $this->nama_racikan,
            'jumlah' => $this->jumlah,
            'aturan_pakai' => $this->aturan_pakai,
            'jumlah_hari' => $this->jumlah_hari,
            'harga' => $this->harga,
            'items' => ApotekPenyimpananObatItemResource::collection($this->whenLoaded('items')),
            'bpjs_no_pelayanan_obat' => $this->bpjs_no_pelayanan_obat,
            'status' => $this->status,
            'bpjs_message' => $this->bpjs_message,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
