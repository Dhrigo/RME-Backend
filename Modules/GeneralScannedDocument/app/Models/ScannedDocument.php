<?php

namespace Modules\GeneralScannedDocument\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralScannedDocument\Database\Factories\ScannedDocumentFactory;
// use Modules\GeneralScannedDocument\Database\Factories\ScannedDocumentFactory;

class ScannedDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): ScannedDocumentFactory
    {
        return ScannedDocumentFactory::new();
    }
}
