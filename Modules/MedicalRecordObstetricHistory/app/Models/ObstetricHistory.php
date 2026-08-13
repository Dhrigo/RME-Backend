<?php

namespace Modules\MedicalRecordObstetricHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordObstetricHistory\Database\Factories\ObstetricHistoryFactory;

class ObstetricHistory extends Model
{
    use HasFactory;

    protected $table = 'obstetric_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'pregnancy_number',
        'delivery_date',
        'delivery_method',
        'birth_weight_grams',
        'complications',
        'outcome',
    ];

    protected function casts(): array
    {
        return [
            'delivery_date' => 'date',
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

    protected static function newFactory(): ObstetricHistoryFactory
    {
        return ObstetricHistoryFactory::new();
    }
}
