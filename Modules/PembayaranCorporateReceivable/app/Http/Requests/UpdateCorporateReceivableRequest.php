<?php

namespace Modules\PembayaranCorporateReceivable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;

class UpdateCorporateReceivableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:' . implode(',', CorporateReceivable::STATUSES)],
        ];
    }
}
