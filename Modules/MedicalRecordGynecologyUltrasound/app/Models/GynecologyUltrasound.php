<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordGynecologyUltrasound\Database\Factories\GynecologyUltrasoundFactory;

class GynecologyUltrasound extends Model
{
    use HasFactory;

    protected $table = 'gynecology_ultrasounds';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'doctor_id',
        'exam_date',
        'uterus_findings',
        'right_ovary_findings',
        'left_ovary_findings',
        'endometrial_thickness_mm',
        'conclusion',
        'created_by',
    ];

    protected $casts = [
        'exam_date' => 'datetime',
        'endometrial_thickness_mm' => 'decimal:2',
    ];

    protected static function newFactory(): GynecologyUltrasoundFactory
    {
        return GynecologyUltrasoundFactory::new();
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
