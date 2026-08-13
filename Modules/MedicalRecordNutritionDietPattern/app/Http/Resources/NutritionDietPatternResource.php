<?php

namespace Modules\MedicalRecordNutritionDietPattern\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NutritionDietPatternResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessed_by' => $this->assessed_by,
            'created_by' => $this->created_by,
            'diet_type' => $this->diet_type,
            'appetite' => $this->appetite,
            'meal_frequency_per_day' => $this->meal_frequency_per_day,
            'food_allergies' => $this->food_allergies,
            'special_diet_notes' => $this->special_diet_notes,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
