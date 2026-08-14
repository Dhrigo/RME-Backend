<?php

namespace Modules\BpjsVClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_type' => $this->visit_type,
            'patient_id' => $this->patient_id,
            'no_kartu' => $this->no_kartu,
            'no_rujukan' => $this->no_rujukan,
            'no_sep' => $this->no_sep,
            'tgl_sep' => $this->tgl_sep?->toDateString(),
            'poli_tujuan' => $this->poli_tujuan,
            'kelas_rawat' => $this->kelas_rawat,
            'dpjp_doctor_id' => $this->dpjp_doctor_id,
            'diagnosa_awal' => $this->diagnosa_awal,
            'catatan' => $this->catatan,
            'no_surat_kontrol' => $this->no_surat_kontrol,
            'status_kecelakaan' => $this->status_kecelakaan,
            'kecelakaan_provinsi_code' => $this->kecelakaan_provinsi_code,
            'kecelakaan_kabupaten_code' => $this->kecelakaan_kabupaten_code,
            'kecelakaan_kecamatan_code' => $this->kecelakaan_kecamatan_code,
            'suplesi_jasa_raharja' => $this->suplesi_jasa_raharja,
            'local_status' => $this->local_status,
            'bpjs_response' => $this->bpjs_response,
            'error_message' => $this->error_message,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
