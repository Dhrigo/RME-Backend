<?php

namespace Modules\BerkasKlaimSupportingDocument\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportingDocument extends Model
{
    use HasFactory;

    protected $fillable = ['claim_file_id', 'document_type', 'file_path', 'uploaded_at'];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Modules\BerkasKlaimSupportingDocument\Database\Factories\SupportingDocumentFactory::new();
    }
}
