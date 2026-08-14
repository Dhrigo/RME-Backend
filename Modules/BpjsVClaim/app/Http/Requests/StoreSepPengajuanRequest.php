<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSepPengajuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sep_id' => ['required', 'integer', 'exists:seps,id'],
            'jenis' => ['required', 'string', 'in:backdate,fingerprint'],
            'alasan' => ['required', 'string'],
        ];
    }
}
