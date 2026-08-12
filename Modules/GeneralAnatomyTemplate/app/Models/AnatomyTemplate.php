<?php

namespace Modules\GeneralAnatomyTemplate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralAnatomyTemplate\Database\Factories\AnatomyTemplateFactory;

class AnatomyTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): AnatomyTemplateFactory
    {
        return AnatomyTemplateFactory::new();
    }
}
