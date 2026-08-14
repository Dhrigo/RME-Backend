<?php

namespace Modules\BpjsVClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RujukanAntarRsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'no_sep_asal' => $this->no_sep_asal,
            'tanggal_rencana_kunjungan' => $this->tanggal_rencana_kunjungan?->toDateString(),
            'jenis_pelayanan' => $this->jenis_pelayanan,
            'tipe_rujukan' => $this->tipe_rujukan,
            'ppk_tujuan' => $this->ppk_tujuan,
            'diagnosa' => $this->diagnosa,
            'catatan' => $this->catatan,
            'no_rujukan' => $this->no_rujukan,
            'local_status' => $this->local_status,
            'bpjs_response' => $this->bpjs_response,
            'error_message' => $this->error_message,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
