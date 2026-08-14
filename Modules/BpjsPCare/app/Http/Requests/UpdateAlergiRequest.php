<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlergiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reaksi' => ['nullable', 'string'],
            'tingkat_keparahan' => ['nullable', 'string', 'in:ringan,sedang,berat'],
        ];
    }
}
