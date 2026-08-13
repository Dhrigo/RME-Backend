<?php

namespace Modules\GeneralReportType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralReportType\Database\Factories\ReportTypeFactory;

class ReportType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'class_name', 'module', 'level', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ReportTypeFactory
    {
        return ReportTypeFactory::new();
    }
}
