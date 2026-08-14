<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMcuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hasil_mcu' => ['nullable', 'string'],
            'rekomendasi' => ['nullable', 'string'],
        ];
    }
}
