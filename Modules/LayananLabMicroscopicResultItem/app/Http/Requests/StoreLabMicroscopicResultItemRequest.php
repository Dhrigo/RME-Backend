<?php

namespace Modules\LayananLabMicroscopicResultItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabMicroscopicResultItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_microscopic_result_id' => ['required', 'integer', 'exists:lab_microscopic_results,id'],
            'parameter_name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
        ];
    }
}
