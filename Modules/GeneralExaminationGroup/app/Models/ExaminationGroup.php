<?php

namespace Modules\GeneralExaminationGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralExaminationGroup\Database\Factories\ExaminationGroupFactory;

class ExaminationGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ExaminationGroupFactory
    {
        return ExaminationGroupFactory::new();
    }
}
