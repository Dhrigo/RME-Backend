<?php

namespace Modules\GeneralIcdOTopography\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralIcdOTopography\Database\Factories\IcdOTopographyFactory;

class IcdOTopography extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): IcdOTopographyFactory
    {
        return IcdOTopographyFactory::new();
    }
}
