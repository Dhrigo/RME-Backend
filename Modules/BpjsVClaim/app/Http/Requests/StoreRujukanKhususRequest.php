<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRujukanKhususRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_rujukan_asal' => ['required', 'string'],
            'diagnosa' => ['required', 'string'],
            'kode_prosedur' => ['required', 'string'],
        ];
    }
}
