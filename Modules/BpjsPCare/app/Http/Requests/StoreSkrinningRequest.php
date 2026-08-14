<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkrinningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kunjungan_id' => ['required', 'exists:kunjungans,id'],
            'jenis_skrinning' => ['required', 'string', 'max:50'],
            'pertanyaan' => ['required', 'string'],
            'jawaban' => ['required', 'string'],
            'skor' => ['nullable', 'integer', 'min:0'],
            'kesimpulan' => ['nullable', 'string'],
        ];
    }
}
