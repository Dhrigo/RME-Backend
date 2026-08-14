<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKunjunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_dokter' => ['nullable', 'string', 'max:10'],
            'keluhan' => ['nullable', 'string'],
            'kode_status_pulang' => ['nullable', 'string', 'max:5'],
            'tensi_sistole' => ['nullable', 'integer', 'min:0', 'max:400'],
            'tensi_diastole' => ['nullable', 'integer', 'min:0', 'max:300'],
        ];
    }
}
