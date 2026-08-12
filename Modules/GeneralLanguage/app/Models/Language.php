<?php

namespace Modules\GeneralLanguage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralLanguage\Database\Factories\LanguageFactory;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): LanguageFactory
    {
        return LanguageFactory::new();
    }
}
