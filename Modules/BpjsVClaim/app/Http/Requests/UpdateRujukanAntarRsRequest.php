<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRujukanAntarRsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_rencana_kunjungan' => ['nullable', 'date'],
            'jenis_pelayanan' => ['nullable', 'string', 'in:1,2'],
            'tipe_rujukan' => ['nullable', 'string', 'in:0,1,2'],
            'ppk_tujuan' => ['nullable', 'string'],
            'diagnosa' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}
