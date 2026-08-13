<?php

namespace Modules\GeneralDiagnosisRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralDiagnosisRestriction\Database\Factories\DiagnosisRestrictionFactory;

class DiagnosisRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_code_id',
        'restricted_antibiotic_name',
        'requires_justification',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'requires_justification' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function diagnosisCode(): BelongsTo
    {
        return $this->belongsTo(DiagnosisCode::class);
    }

    protected static function newFactory(): DiagnosisRestrictionFactory
    {
        return DiagnosisRestrictionFactory::new();
    }
}
