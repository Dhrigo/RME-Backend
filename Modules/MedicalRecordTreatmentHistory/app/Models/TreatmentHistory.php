<?php

namespace Modules\MedicalRecordTreatmentHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordTreatmentHistory\Database\Factories\TreatmentHistoryFactory;

class TreatmentHistory extends Model
{
    use HasFactory;

    protected $table = 'treatment_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'treatment_description',
        'facility_name',
        'treatment_date',
        'outcome',
    ];

    protected function casts(): array
    {
        return [
            'treatment_date' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): TreatmentHistoryFactory
    {
        return TreatmentHistoryFactory::new();
    }
}
