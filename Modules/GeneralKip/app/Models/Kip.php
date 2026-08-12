<?php

namespace Modules\GeneralKip\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralKip\Database\Factories\KipFactory;

class Kip extends Model
{
    use HasFactory;

    protected $table = 'kips';

    protected $fillable = [
        'patient_norm', 'card_type', 'card_number', 'address', 'rt', 'rw', 'postal_code', 'region_code',
    ];

    protected static function newFactory(): KipFactory
    {
        return KipFactory::new();
    }
}
