<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMcuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kunjungan_id' => ['required', 'exists:kunjungans,id'],
            'tanggal_mcu' => ['required', 'date'],
            'tinggi_badan' => ['required', 'numeric', 'min:0'],
            'berat_badan' => ['required', 'numeric', 'min:0'],
            'lingkar_perut' => ['nullable', 'numeric', 'min:0'],
            'tensi_sistole' => ['nullable', 'integer', 'min:0', 'max:400'],
            'tensi_diastole' => ['nullable', 'integer', 'min:0', 'max:300'],
            'gula_darah' => ['nullable', 'numeric', 'min:0'],
            'kolesterol' => ['nullable', 'numeric', 'min:0'],
            'asam_urat' => ['nullable', 'numeric', 'min:0'],
            'hasil_mcu' => ['nullable', 'string'],
            'rekomendasi' => ['nullable', 'string'],
        ];
    }
}
