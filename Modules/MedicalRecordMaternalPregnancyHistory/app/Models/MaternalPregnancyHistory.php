<?php

namespace Modules\MedicalRecordMaternalPregnancyHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMaternalPregnancyHistory\Database\Factories\MaternalPregnancyHistoryFactory;

class MaternalPregnancyHistory extends Model
{
    use HasFactory;

    protected $table = 'maternal_pregnancy_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'gravida',
        'para',
        'abortus',
        'pregnancy_complications',
        'delivery_method_history',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): MaternalPregnancyHistoryFactory
    {
        return MaternalPregnancyHistoryFactory::new();
    }
}
