<?php

namespace Modules\BpjsPCare\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkrinningResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'kunjungan_id' => $this->kunjungan_id,
            'jenis_skrinning' => $this->jenis_skrinning,
            'pertanyaan' => $this->pertanyaan,
            'jawaban' => $this->jawaban,
            'skor' => $this->skor,
            'kesimpulan' => $this->kesimpulan,
            'bpjs_response' => $this->bpjs_response,
            'bpjs_error' => $this->bpjs_error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
