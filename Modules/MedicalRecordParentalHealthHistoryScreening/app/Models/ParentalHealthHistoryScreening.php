<?php

namespace Modules\MedicalRecordParentalHealthHistoryScreening\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordParentalHealthHistoryScreening\Database\Factories\ParentalHealthHistoryScreeningFactory;

class ParentalHealthHistoryScreening extends Model
{
    use HasFactory;

    protected $table = 'parental_health_history_screenings';

    protected $fillable = [
        'visit_id',
        'screened_by',
        'created_by',
        'father_health_conditions',
        'mother_health_conditions',
        'consanguinity',
        'genetic_disorder_history',
        'screened_at',
    ];

    protected function casts(): array
    {
        return [
            'consanguinity' => 'boolean',
            'screened_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function screenedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'screened_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): ParentalHealthHistoryScreeningFactory
    {
        return ParentalHealthHistoryScreeningFactory::new();
    }
}
