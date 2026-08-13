<?php

namespace Modules\MedicalRecordInterventionProtocol\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordInterventionProtocol\Database\Factories\InterventionProtocolFactory;

class InterventionProtocol extends Model
{
    use HasFactory;

    protected $table = 'intervention_protocols';

    protected $fillable = [
        'visit_id',
        'started_by',
        'created_by',
        'protocol_name',
        'indication',
        'status',
        'started_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function startedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'started_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): InterventionProtocolFactory
    {
        return InterventionProtocolFactory::new();
    }
}
