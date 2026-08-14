<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrognosaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hasil_prognosa' => ['sometimes', 'string', 'in:sembuh,membaik,tetap,memburuk,meninggal'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}
