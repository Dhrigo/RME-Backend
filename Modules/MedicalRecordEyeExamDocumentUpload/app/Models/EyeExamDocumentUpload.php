<?php

namespace Modules\MedicalRecordEyeExamDocumentUpload\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordEyeExamDocumentUpload\Database\Factories\EyeExamDocumentUploadFactory;

class EyeExamDocumentUpload extends Model
{
    use HasFactory;

    protected $table = 'eye_exam_document_uploads';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'doctor_id',
        'exam_date',
        'file_path',
        'eye_side',
        'findings',
        'created_by',
    ];

    protected $casts = [
        'exam_date' => 'datetime',
    ];

    protected static function newFactory(): EyeExamDocumentUploadFactory
    {
        return EyeExamDocumentUploadFactory::new();
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
