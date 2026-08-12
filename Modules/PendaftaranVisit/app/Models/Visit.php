<?php

namespace Modules\PendaftaranVisit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Database\Factories\VisitFactory;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_number',
        'registration_id',
        'attending_physician_id',
        'room_id',
        'bed_id',
        'admitted_at',
        'discharged_at',
        'is_new_visit',
        'is_deposit',
        'deposit_class_id',
        'received_by',
        'final_outcome',
        'final_outcome_by',
        'final_outcome_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'admitted_at' => 'datetime',
            'discharged_at' => 'datetime',
            'is_new_visit' => 'boolean',
            'is_deposit' => 'boolean',
            'final_outcome_at' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function attendingPhysician(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'attending_physician_id');
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function finalOutcomeBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'final_outcome_by');
    }

    /**
     * Format: KJ-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateVisitNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('visit_number', 'like', "KJ-{$year}-%")->count();

        return sprintf('KJ-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): VisitFactory
    {
        return VisitFactory::new();
    }
}
