<?php

namespace Modules\BpjsRekamMedis\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KlaimResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no_sep' => $this->no_sep,
            'jenis_pelayanan_id' => $this->jenis_pelayanan_id,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'dibuat_oleh' => $this->dibuat_oleh,
            'dibuat_tanggal' => $this->dibuat_tanggal,
            'dikirim_oleh' => $this->dikirim_oleh,
            'dikirim_tanggal' => $this->dikirim_tanggal,
            'status' => $this->status,
            'error_message' => $this->error_message,
        ];
    }
}
