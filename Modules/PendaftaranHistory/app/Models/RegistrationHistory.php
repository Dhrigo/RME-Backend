<?php

namespace Modules\PendaftaranHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranHistory\Database\Factories\RegistrationHistoryFactory;
use Modules\PendaftaranRegistration\Models\Registration;

/**
 * Append-only audit trail of PendaftaranRegistration.status transitions - same
 * append-only shape as MedicalRecordVitalSign, no update/delete route.
 */
class RegistrationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'old_status',
        'new_status',
        'changed_by',
        'changed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'changed_at' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    protected static function newFactory(): RegistrationHistoryFactory
    {
        return RegistrationHistoryFactory::new();
    }
}
