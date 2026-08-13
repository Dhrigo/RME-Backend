<?php

namespace Modules\MedicalRecordFamilyMedicalHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFamilyMedicalHistory\Database\Factories\FamilyMedicalHistoryFactory;

class FamilyMedicalHistory extends Model
{
    use HasFactory;

    protected $table = 'family_medical_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'relation',
        'condition',
        'diagnosed_age',
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

    protected static function newFactory(): FamilyMedicalHistoryFactory
    {
        return FamilyMedicalHistoryFactory::new();
    }
}
