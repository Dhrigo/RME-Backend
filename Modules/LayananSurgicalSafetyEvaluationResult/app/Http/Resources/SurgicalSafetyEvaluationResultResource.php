<?php

namespace Modules\LayananSurgicalSafetyEvaluationResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurgicalSafetyEvaluationResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'operating_room_id' => $this->operating_room_id,
            'evaluator_id' => $this->evaluator_id,
            'checklist_score' => $this->checklist_score,
            'compliant' => $this->compliant,
            'evaluated_at' => $this->evaluated_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
