<?php

namespace Modules\LayananTreatmentProtocol\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananTreatmentProtocol\Database\Factories\TreatmentProtocolFactory;

class TreatmentProtocol extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'protocol_name',
        'prescribed_by',
        'started_at',
        'ended_at',
        'status',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function prescribedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'prescribed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\Auth\Models\User::class, 'created_by');
    }

    protected static function newFactory(): TreatmentProtocolFactory
    {
        return TreatmentProtocolFactory::new();
    }
}
