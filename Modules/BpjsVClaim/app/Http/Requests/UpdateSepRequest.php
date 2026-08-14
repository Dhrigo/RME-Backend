<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'poli_tujuan' => ['nullable', 'string'],
            'kelas_rawat' => ['nullable', 'string'],
            'dpjp_doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
            'diagnosa_awal' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'no_surat_kontrol' => ['nullable', 'string'],
            'status_kecelakaan' => ['nullable', 'string', 'in:0,1,2,3'],
            'kecelakaan_provinsi_code' => ['nullable', 'string'],
            'kecelakaan_kabupaten_code' => ['nullable', 'string'],
            'kecelakaan_kecamatan_code' => ['nullable', 'string'],
            'suplesi_jasa_raharja' => ['nullable', 'boolean'],
        ];
    }
}
