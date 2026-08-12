<?php

namespace Modules\GeneralProcedure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralProcedure\Database\Factories\ProcedureFactory;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ProcedureFactory
    {
        return ProcedureFactory::new();
    }
}
