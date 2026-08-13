<?php

namespace Modules\GeneralReportTypeItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportTypeItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'report_type_id' => $this->report_type_id,
            'name' => $this->name,
            'code' => $this->code,
            'sequence' => $this->sequence,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
