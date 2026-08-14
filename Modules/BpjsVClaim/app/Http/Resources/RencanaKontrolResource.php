<?php

namespace Modules\BpjsVClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RencanaKontrolResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sep_id' => $this->sep_id,
            'jenis_kontrol' => $this->jenis_kontrol,
            'poli_kontrol' => $this->poli_kontrol,
            'tanggal_rencana_kontrol' => $this->tanggal_rencana_kontrol?->toDateString(),
            'dpjp_doctor_id' => $this->dpjp_doctor_id,
            'no_surat_kontrol' => $this->no_surat_kontrol,
            'local_status' => $this->local_status,
            'bpjs_response' => $this->bpjs_response,
            'error_message' => $this->error_message,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
