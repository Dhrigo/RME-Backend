<?php

namespace Modules\PembayaranPatientReceivable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;

class UpdatePatientReceivableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:' . implode(',', PatientReceivable::STATUSES)],
        ];
    }
}
