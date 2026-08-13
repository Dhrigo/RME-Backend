<?php

namespace Modules\MedicalRecordProcedureSurgery\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordProcedureSurgery\Database\Factories\ProcedureSurgeryFactory;

class ProcedureSurgery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'procedure_surgeries';

    protected $fillable = [
        'visit_id',
        'procedure_id',
        'surgery_name',
        'surgery_type',
        'anesthesia_type',
        'performed_at',
        'notes',
    ];

    protected $casts = [
        'performed_at' => 'datetime',
    ];

    protected static function newFactory(): ProcedureSurgeryFactory
    {
        return ProcedureSurgeryFactory::new();
    }
}
