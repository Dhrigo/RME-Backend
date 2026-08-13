<?php

namespace Modules\MedicalRecordImplementationNote\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImplementationNote\Database\Factories\ImplementationNoteFactory;

class ImplementationNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'note_type',
        'content',
        'recorded_by',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): ImplementationNoteFactory
    {
        return ImplementationNoteFactory::new();
    }
}
