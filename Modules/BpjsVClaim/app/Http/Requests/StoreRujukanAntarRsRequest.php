<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRujukanAntarRsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'no_sep_asal' => ['required', 'string'],
            'tanggal_rencana_kunjungan' => ['required', 'date'],
            'jenis_pelayanan' => ['required', 'string', 'in:1,2'],
            'tipe_rujukan' => ['required', 'string', 'in:0,1,2'],
            'ppk_tujuan' => ['required', 'string'],
            'diagnosa' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}
