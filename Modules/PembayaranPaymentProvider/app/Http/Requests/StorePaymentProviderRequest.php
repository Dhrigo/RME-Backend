<?php

namespace Modules\PembayaranPaymentProvider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;

class StorePaymentProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_code' => ['nullable', 'string', 'max:255', 'unique:payment_providers,provider_code'],
            'provider_name' => ['required', 'string', 'max:255'],
            'provider_type' => ['sometimes', Rule::in(PaymentProvider::PROVIDER_TYPES)],
            'merchant_id' => ['nullable', 'string', 'max:255'],
            'api_base_url' => ['nullable', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
