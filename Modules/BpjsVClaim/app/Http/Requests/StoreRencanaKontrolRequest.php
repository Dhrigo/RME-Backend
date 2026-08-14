<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRencanaKontrolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sep_id' => ['required', 'integer', 'exists:seps,id'],
            'jenis_kontrol' => ['required', 'string'],
            'poli_kontrol' => ['required', 'string'],
            'tanggal_rencana_kontrol' => ['required', 'date'],
            'dpjp_doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
        ];
    }
}
