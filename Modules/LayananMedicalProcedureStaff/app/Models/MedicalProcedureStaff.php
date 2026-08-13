<?php

namespace Modules\LayananMedicalProcedureStaff\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\LayananMedicalProcedureStaff\Database\Factories\MedicalProcedureStaffFactory;

class MedicalProcedureStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_procedure_id',
        'employee_id',
        'role',
        'notes',
    ];

    public function medicalProcedure(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananMedicalProcedure\Models\MedicalProcedure::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class);
    }

    protected static function newFactory(): MedicalProcedureStaffFactory
    {
        return MedicalProcedureStaffFactory::new();
    }
}
