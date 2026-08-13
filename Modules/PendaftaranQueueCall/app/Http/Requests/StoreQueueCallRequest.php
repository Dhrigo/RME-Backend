<?php

namespace Modules\PendaftaranQueueCall\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQueueCallRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_queue_id' => ['required', 'integer', 'exists:ward_queues,id'],
            'counter' => ['required', 'string', 'max:20'],
        ];
    }
}
