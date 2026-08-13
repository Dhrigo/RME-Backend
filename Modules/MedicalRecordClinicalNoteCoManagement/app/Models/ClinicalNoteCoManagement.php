<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordClinicalNoteCoManagement\Database\Factories\ClinicalNoteCoManagementFactory;

class ClinicalNoteCoManagement extends Model
{
    use HasFactory;

    protected $table = 'clinical_note_co_managements';

    protected $fillable = [
        'clinical_note_id',
        'medical_department_id',
        'notes',
        'author_id',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function clinicalNote(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordClinicalNote\Models\ClinicalNote::class);
    }

    public function medicalDepartment(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralMedicalDepartment\Models\MedicalDepartment::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class);
    }

    protected static function newFactory(): ClinicalNoteCoManagementFactory
    {
        return ClinicalNoteCoManagementFactory::new();
    }
}
