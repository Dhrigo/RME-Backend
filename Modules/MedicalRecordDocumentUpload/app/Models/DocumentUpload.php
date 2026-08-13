<?php

namespace Modules\MedicalRecordDocumentUpload\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\Auth\Models\User;
use Modules\MedicalRecordDocumentUpload\Database\Factories\DocumentUploadFactory;

class DocumentUpload extends Model
{
    use HasFactory;

    protected $table = 'document_uploads';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'document_name',
        'document_type',
        'file_path',
        'file_size_bytes',
        'uploaded_at',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'file_size_bytes' => 'integer',
    ];

    protected static function newFactory(): DocumentUploadFactory
    {
        return DocumentUploadFactory::new();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
