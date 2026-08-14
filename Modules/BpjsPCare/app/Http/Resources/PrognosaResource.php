<?php

namespace Modules\BpjsPCare\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrognosaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'kunjungan_id' => $this->kunjungan_id,
            'kode_diagnosa' => $this->kode_diagnosa,
            'nama_diagnosa' => $this->nama_diagnosa,
            'hasil_prognosa' => $this->hasil_prognosa,
            'catatan' => $this->catatan,
            'bpjs_response' => $this->bpjs_response,
            'bpjs_error' => $this->bpjs_error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
