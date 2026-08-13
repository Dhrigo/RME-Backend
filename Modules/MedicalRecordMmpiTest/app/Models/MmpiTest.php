<?php

namespace Modules\MedicalRecordMmpiTest\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordMmpiTest\Database\Factories\MmpiTestFactory;

class MmpiTest extends Model
{
    use HasFactory;

    protected $table = 'mmpi_tests';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'doctor_id',
        'test_date',
        'validity_scale_l',
        'validity_scale_f',
        'validity_scale_k',
        'clinical_scales_summary',
        'interpretation',
        'conclusion',
        'created_by',
    ];

    protected $casts = [
        'test_date' => 'datetime',
        'validity_scale_l' => 'integer',
        'validity_scale_f' => 'integer',
        'validity_scale_k' => 'integer',
        'clinical_scales_summary' => 'array',
    ];

    protected static function newFactory(): MmpiTestFactory
    {
        return MmpiTestFactory::new();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
