<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModifiedBarthelIndexAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'feeding' => $this->feeding,
            'bathing' => $this->bathing,
            'personal_hygiene' => $this->personal_hygiene,
            'dressing' => $this->dressing,
            'bowel_control' => $this->bowel_control,
            'bladder_control' => $this->bladder_control,
            'toilet_use' => $this->toilet_use,
            'chair_bed_transfer' => $this->chair_bed_transfer,
            'ambulation' => $this->ambulation,
            'stairs' => $this->stairs,
            'total_score' => $this->total_score,
            'interpretation' => $this->interpretation,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
