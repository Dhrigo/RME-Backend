<?php

namespace Modules\MedicalRecordMaternalPregnancyHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaternalPregnancyHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'gravida' => $this->gravida,
            'para' => $this->para,
            'abortus' => $this->abortus,
            'pregnancy_complications' => $this->pregnancy_complications,
            'delivery_method_history' => $this->delivery_method_history,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
