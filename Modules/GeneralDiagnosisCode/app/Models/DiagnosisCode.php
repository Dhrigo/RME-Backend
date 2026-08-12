<?php

namespace Modules\GeneralDiagnosisCode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralDiagnosisCode\Database\Factories\DiagnosisCodeFactory;

class DiagnosisCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): DiagnosisCodeFactory
    {
        return DiagnosisCodeFactory::new();
    }
}
