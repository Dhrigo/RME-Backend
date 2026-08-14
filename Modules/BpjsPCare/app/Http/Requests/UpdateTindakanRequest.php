<?php

namespace Modules\BpjsPCare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTindakanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelaksana' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}
