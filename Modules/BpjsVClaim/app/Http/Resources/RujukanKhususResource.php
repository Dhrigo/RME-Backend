<?php

namespace Modules\BpjsVClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RujukanKhususResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no_rujukan_asal' => $this->no_rujukan_asal,
            'diagnosa' => $this->diagnosa,
            'kode_prosedur' => $this->kode_prosedur,
            'no_rujukan_khusus' => $this->no_rujukan_khusus,
            'local_status' => $this->local_status,
            'bpjs_response' => $this->bpjs_response,
            'error_message' => $this->error_message,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
