<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkrinningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jawaban' => ['sometimes', 'string'],
            'skor' => ['nullable', 'integer', 'min:0'],
            'kesimpulan' => ['nullable', 'string'],
        ];
    }
}
