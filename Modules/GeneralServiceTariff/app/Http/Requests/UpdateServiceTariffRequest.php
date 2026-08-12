<?php

namespace Modules\GeneralServiceTariff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceTariffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_class_id' => ['nullable', 'integer', 'exists:room_classes,id'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'effective_date' => ['sometimes', 'date'],
            'decree_number' => ['nullable', 'string', 'max:255'],
            'decree_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
