<?php

namespace Modules\GeneralReportTypeItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportTypeItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'report_type_id' => ['required', 'integer', 'exists:report_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'sequence' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
