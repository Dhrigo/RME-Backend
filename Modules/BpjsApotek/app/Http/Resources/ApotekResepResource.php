<?php

namespace Modules\BpjsApotek\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApotekResepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'prescription_id' => $this->prescription_id,
            'no_sep' => $this->no_sep,
            'no_kartu' => $this->no_kartu,
            'tanggal_resep' => $this->tanggal_resep?->toDateString(),
            'poli_kode' => $this->poli_kode,
            'bpjs_no_resep' => $this->bpjs_no_resep,
            'status' => $this->status,
            'bpjs_message' => $this->bpjs_message,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
