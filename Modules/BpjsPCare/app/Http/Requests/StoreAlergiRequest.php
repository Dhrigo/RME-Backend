<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlergiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kunjungan_id' => ['required', 'exists:kunjungans,id'],
            'jenis_alergi' => ['required', 'string', 'in:obat,makanan,lainnya'],
            'nama_alergi' => ['required', 'string', 'max:255'],
            'reaksi' => ['nullable', 'string'],
            'tingkat_keparahan' => ['nullable', 'string', 'in:ringan,sedang,berat'],
        ];
    }
}
