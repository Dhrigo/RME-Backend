<?php

namespace Modules\MedicalRecordEndOfLifePsychosocialRelationship\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Database\Factories\EndOfLifePsychosocialRelationshipFactory;

class EndOfLifePsychosocialRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'relationship_type',
        'support_system',
        'spiritual_needs',
        'emotional_state',
        'assessed_by',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'assessed_by');
    }

    protected static function newFactory(): EndOfLifePsychosocialRelationshipFactory
    {
        return EndOfLifePsychosocialRelationshipFactory::new();
    }
}
