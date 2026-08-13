<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPatientFamilyEducation\Database\Factories\PatientFamilyEducationFactory;

class PatientFamilyEducation extends Model
{
    use HasFactory;

    protected $table = 'patient_family_educations';

    protected $fillable = [
        'visit_id',
        'topic',
        'method',
        'barrier',
        'understanding_level',
        're_education_needed',
        'educator_id',
        'educated_at',
    ];

    protected function casts(): array
    {
        return [
            're_education_needed' => 'boolean',
            'educated_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function educator(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class);
    }

    protected static function newFactory(): PatientFamilyEducationFactory
    {
        return PatientFamilyEducationFactory::new();
    }
}
