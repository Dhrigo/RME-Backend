<?php

namespace Modules\PendaftaranQueueCall\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QueueCallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_queue_id' => $this->ward_queue_id,
            'called_at' => $this->called_at?->toIso8601String(),
            'called_by' => $this->called_by,
            'counter' => $this->counter,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
