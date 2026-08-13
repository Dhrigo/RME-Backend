<?php

namespace Modules\GeneralOtherServiceTariff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOtherServiceTariffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'other_service_id' => ['required', 'integer', 'exists:other_services,id'],
            'room_class_id' => ['nullable', 'integer', 'exists:room_classes,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
