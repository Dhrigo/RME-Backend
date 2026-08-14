<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrognosaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kunjungan_id' => ['required', 'exists:kunjungans,id'],
            'kode_diagnosa' => ['required', 'string', 'max:10'],
            'nama_diagnosa' => ['required', 'string', 'max:255'],
            'hasil_prognosa' => ['required', 'string', 'in:sembuh,membaik,tetap,memburuk,meninggal'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}
