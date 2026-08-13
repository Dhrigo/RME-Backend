<?php

namespace Modules\MedicalRecordPatientTransferSheet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordPatientTransferSheet\Database\Factories\PatientTransferSheetFactory;

class PatientTransferSheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'visit_id',
        'patient_id',
        'from_ward_id',
        'to_ward_id',
        'transfer_reason',
        'patient_condition',
        'transferred_at',
        'transferred_by',
    ];

    protected $casts = [
        'transferred_at' => 'datetime',
    ];

    protected static function newFactory(): PatientTransferSheetFactory
    {
        return PatientTransferSheetFactory::new();
    }
}
