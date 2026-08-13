<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralMedicalDepartmentWardAssignment\Database\Factories\MedicalDepartmentWardAssignmentFactory;
use Modules\GeneralWard\Models\Ward;

class MedicalDepartmentWardAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_department_id',
        'ward_id',
        'is_primary',
        'assigned_at',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'assigned_at' => 'date',
        ];
    }

    public function medicalDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): MedicalDepartmentWardAssignmentFactory
    {
        return MedicalDepartmentWardAssignmentFactory::new();
    }
}
