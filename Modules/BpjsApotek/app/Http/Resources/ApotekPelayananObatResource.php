<?php

namespace Modules\BpjsApotek\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApotekPelayananObatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'resep_id' => $this->resep_id,
            'no_sep' => $this->no_sep,
            'tanggal_pelayanan' => $this->tanggal_pelayanan?->toDateString(),
            'bpjs_no_pelayanan' => $this->bpjs_no_pelayanan,
            'status' => $this->status,
            'bpjs_message' => $this->bpjs_message,
            'is_locked' => $this->is_locked,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
