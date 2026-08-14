<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRencanaKontrolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_kontrol' => ['nullable', 'string'],
            'poli_kontrol' => ['nullable', 'string'],
            'tanggal_rencana_kontrol' => ['nullable', 'date'],
            'dpjp_doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
        ];
    }
}
