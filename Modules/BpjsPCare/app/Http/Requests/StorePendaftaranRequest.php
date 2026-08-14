<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor_urut' => ['required', 'integer', 'min:1'],
            'tanggal_daftar' => ['required', 'date'],
            'no_kartu' => ['required', 'string', 'max:20'],
            'nik' => ['nullable', 'string', 'max:20'],
            'nama_pasien' => ['required', 'string', 'max:255'],
            'poli_tujuan' => ['required', 'string', 'max:10'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'keluhan' => ['nullable', 'string'],
        ];
    }
}
