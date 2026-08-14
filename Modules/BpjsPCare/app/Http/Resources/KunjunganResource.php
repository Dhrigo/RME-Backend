<?php

namespace Modules\BpjsPCare\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KunjunganResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pendaftaran_id' => $this->pendaftaran_id,
            'nomor_kunjungan' => $this->nomor_kunjungan,
            'no_kartu' => $this->no_kartu,
            'tanggal_kunjungan' => $this->tanggal_kunjungan,
            'jenis_kunjungan' => $this->jenis_kunjungan,
            'kode_poli' => $this->kode_poli,
            'kode_dokter' => $this->kode_dokter,
            'no_rujukan' => $this->no_rujukan,
            'keluhan' => $this->keluhan,
            'tensi_sistole' => $this->tensi_sistole,
            'tensi_diastole' => $this->tensi_diastole,
            'nadi' => $this->nadi,
            'suhu' => $this->suhu,
            'pernafasan' => $this->pernafasan,
            'tinggi_badan' => $this->tinggi_badan,
            'berat_badan' => $this->berat_badan,
            'kode_status_pulang' => $this->kode_status_pulang,
            'bpjs_response' => $this->bpjs_response,
            'bpjs_error' => $this->bpjs_error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
