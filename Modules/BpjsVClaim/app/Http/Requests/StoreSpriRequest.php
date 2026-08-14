<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sep_id' => ['required', 'integer', 'exists:seps,id'],
            'tanggal_rencana_rawat_inap' => ['required', 'date'],
            'dpjp_doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
        ];
    }
}
