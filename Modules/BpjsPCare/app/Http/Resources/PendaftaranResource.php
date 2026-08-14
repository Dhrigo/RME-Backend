<?php

namespace Modules\BpjsPCare\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nomor_urut' => $this->nomor_urut,
            'tanggal_daftar' => $this->tanggal_daftar,
            'no_kartu' => $this->no_kartu,
            'nik' => $this->nik,
            'nama_pasien' => $this->nama_pasien,
            'poli_tujuan' => $this->poli_tujuan,
            'no_hp' => $this->no_hp,
            'keluhan' => $this->keluhan,
            'status' => $this->status,
            'bpjs_no_pendaftaran' => $this->bpjs_no_pendaftaran,
            'bpjs_response' => $this->bpjs_response,
            'bpjs_error' => $this->bpjs_error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
