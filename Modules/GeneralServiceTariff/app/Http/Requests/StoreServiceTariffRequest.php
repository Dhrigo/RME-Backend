<?php

namespace Modules\GeneralServiceTariff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceTariffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['required', 'numeric', 'min:0'],
            'effective_date' => ['required', 'date'],
            'decree_number' => ['nullable', 'string', 'max:255'],
            'decree_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
