<?php

namespace Modules\BpjsApotek\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApotekResepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'prescription_id' => ['nullable', 'integer', 'exists:prescriptions,id'],
            'no_sep' => ['required', 'string', 'max:20'],
            'no_kartu' => ['required', 'string', 'max:20'],
            'tanggal_resep' => ['required', 'date'],
            'poli_kode' => ['nullable', 'string', 'max:10'],
        ];
    }
}
