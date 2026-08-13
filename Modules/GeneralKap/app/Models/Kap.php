<?php

namespace Modules\GeneralKap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralKap\Database\Factories\KapFactory;

class Kap extends Model
{
    use HasFactory;

    protected $table = 'kaps';

    protected $fillable = ['patient_norm', 'card_type', 'card_number'];

    protected static function newFactory(): KapFactory
    {
        return KapFactory::new();
    }
}
