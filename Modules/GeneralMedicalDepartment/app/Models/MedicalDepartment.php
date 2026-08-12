<?php

namespace Modules\GeneralMedicalDepartment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralMedicalDepartment\Database\Factories\MedicalDepartmentFactory;

class MedicalDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): MedicalDepartmentFactory
    {
        return MedicalDepartmentFactory::new();
    }
}
