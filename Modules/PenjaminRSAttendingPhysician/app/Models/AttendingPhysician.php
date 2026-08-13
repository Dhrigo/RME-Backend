<?php

namespace Modules\PenjaminRSAttendingPhysician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendingPhysician extends Model
{
    use HasFactory;

    protected $fillable = ['visit_id', 'employee_id', 'assigned_at', 'is_primary'];

    protected $casts = [
        'assigned_at' => 'datetime',
        'is_primary' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\PenjaminRSAttendingPhysician\Database\Factories\AttendingPhysicianFactory::new();
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class);
    }
}
