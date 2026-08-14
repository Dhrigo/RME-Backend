<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKunjunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pendaftaran_id' => ['nullable', 'exists:pendaftarans,id'],
            'no_kartu' => ['required', 'string', 'max:20'],
            'tanggal_kunjungan' => ['required', 'date'],
            'jenis_kunjungan' => ['nullable', 'string', 'in:baru,lama'],
            'kode_poli' => ['required', 'string', 'max:10'],
            'kode_dokter' => ['nullable', 'string', 'max:10'],
            'no_rujukan' => ['nullable', 'string', 'max:20'],
            'keluhan' => ['nullable', 'string'],
            'tensi_sistole' => ['nullable', 'integer', 'min:0', 'max:400'],
            'tensi_diastole' => ['nullable', 'integer', 'min:0', 'max:300'],
            'nadi' => ['nullable', 'integer', 'min:0', 'max:300'],
            'suhu' => ['nullable', 'numeric', 'min:30', 'max:45'],
            'pernafasan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:0'],
            'berat_badan' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
