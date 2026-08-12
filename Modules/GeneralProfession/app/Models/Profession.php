<?php

namespace Modules\GeneralProfession\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralProfession\Database\Factories\ProfessionFactory;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ProfessionFactory
    {
        return ProfessionFactory::new();
    }
}
