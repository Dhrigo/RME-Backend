<?php

namespace Modules\GeneralConsultationWard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralConsultationWard\Database\Factories\ConsultationWardFactory;
// use Modules\GeneralConsultationWard\Database\Factories\ConsultationWardFactory;

class ConsultationWard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): ConsultationWardFactory
    {
        return ConsultationWardFactory::new();
    }
}
