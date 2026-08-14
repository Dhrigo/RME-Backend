<?php

namespace Modules\BpjsAntreanRs\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntreanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kodebooking' => $this->kodebooking,
            'visit_id' => $this->visit_id,
            'jenispasien' => $this->jenispasien,
            'nomorkartu' => $this->nomorkartu,
            'kodepoli' => $this->kodepoli,
            'namapoli' => $this->namapoli,
            'norm' => $this->norm,
            'tanggalperiksa' => $this->tanggalperiksa?->toDateString(),
            'kodedokter' => $this->kodedokter,
            'namadokter' => $this->namadokter,
            'jampraktek' => $this->jampraktek,
            'jeniskunjungan' => $this->jeniskunjungan,
            'nomorreferensi' => $this->nomorreferensi,
            'nomorantrean' => $this->nomorantrean,
            'angkaantrean' => $this->angkaantrean,
            'estimasidilayani' => $this->estimasidilayani?->toIso8601String(),
            'status' => $this->status,
            'bpjs_sync_status' => $this->bpjs_sync_status,
            'bpjs_error' => $this->bpjs_error,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
