<?php

namespace Modules\MedicalRecordTriage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordTriage\Database\Factories\TriageFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Triage extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'level',
        'chief_complaint',
        'assessed_by',
        'assessed_at',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assessed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): TriageFactory
    {
        return TriageFactory::new();
    }
}
