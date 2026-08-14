<?php

namespace Modules\BpjsVClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpriResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sep_id' => $this->sep_id,
            'tanggal_rencana_rawat_inap' => $this->tanggal_rencana_rawat_inap?->toDateString(),
            'dpjp_doctor_id' => $this->dpjp_doctor_id,
            'no_spri' => $this->no_spri,
            'local_status' => $this->local_status,
            'bpjs_response' => $this->bpjs_response,
            'error_message' => $this->error_message,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
