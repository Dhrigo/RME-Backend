<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_rencana_rawat_inap' => ['nullable', 'date'],
            'dpjp_doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
        ];
    }
}
