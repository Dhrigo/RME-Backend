<?php

namespace Modules\GeneralEducation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralEducation\Database\Factories\EducationFactory;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): EducationFactory
    {
        return EducationFactory::new();
    }
}
