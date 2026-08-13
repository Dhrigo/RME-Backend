<?php

namespace Modules\MedicalRecordGynecologyHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordGynecologyHistory\Database\Factories\GynecologyHistoryFactory;

class GynecologyHistory extends Model
{
    use HasFactory;

    protected $table = 'gynecology_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'menarche_age',
        'menstrual_cycle_pattern',
        'contraception_history',
        'gynecological_surgery_history',
        'notes',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): GynecologyHistoryFactory
    {
        return GynecologyHistoryFactory::new();
    }
}
