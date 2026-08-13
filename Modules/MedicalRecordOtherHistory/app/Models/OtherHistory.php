<?php

namespace Modules\MedicalRecordOtherHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordOtherHistory\Database\Factories\OtherHistoryFactory;

class OtherHistory extends Model
{
    use HasFactory;

    protected $table = 'other_histories';

    protected $fillable = [
        'visit_id',
        'recorded_by',
        'created_by',
        'category',
        'description',
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
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'recorded_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): OtherHistoryFactory
    {
        return OtherHistoryFactory::new();
    }
}
