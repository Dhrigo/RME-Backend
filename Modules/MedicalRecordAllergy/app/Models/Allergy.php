<?php

namespace Modules\MedicalRecordAllergy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\MedicalRecordAllergy\Database\Factories\AllergyFactory;

class Allergy extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'category',
        'allergen',
        'reaction',
        'severity',
        'is_active',
        'recorded_by',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'recorded_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): AllergyFactory
    {
        return AllergyFactory::new();
    }
}
