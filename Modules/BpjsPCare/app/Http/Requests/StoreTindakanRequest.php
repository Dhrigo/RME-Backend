<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTindakanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kunjungan_id' => ['required', 'exists:kunjungans,id'],
            'kode_tindakan' => ['required', 'string', 'max:10'],
            'nama_tindakan' => ['required', 'string', 'max:255'],
            'tanggal_tindakan' => ['required', 'date'],
            'pelaksana' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}
