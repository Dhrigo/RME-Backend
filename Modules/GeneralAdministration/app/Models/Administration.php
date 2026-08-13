<?php

namespace Modules\GeneralAdministration\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralAdministration\Database\Factories\AdministrationFactory;

class Administration extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): AdministrationFactory
    {
        return AdministrationFactory::new();
    }
}
