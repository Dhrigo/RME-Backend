<?php

namespace Modules\BpjsPCare\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class McuResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'kunjungan_id' => $this->kunjungan_id,
            'tanggal_mcu' => $this->tanggal_mcu,
            'tinggi_badan' => $this->tinggi_badan,
            'berat_badan' => $this->berat_badan,
            'lingkar_perut' => $this->lingkar_perut,
            'tensi_sistole' => $this->tensi_sistole,
            'tensi_diastole' => $this->tensi_diastole,
            'gula_darah' => $this->gula_darah,
            'kolesterol' => $this->kolesterol,
            'asam_urat' => $this->asam_urat,
            'hasil_mcu' => $this->hasil_mcu,
            'rekomendasi' => $this->rekomendasi,
            'bpjs_response' => $this->bpjs_response,
            'bpjs_error' => $this->bpjs_error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
