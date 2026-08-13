<?php

namespace Modules\GeneralScannedDocument\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralScannedDocument\Database\Factories\ScannedDocumentFactory;

class ScannedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'document_type',
        'file_path',
        'scanned_at',
        'scanned_by',
    ];

    protected function casts(): array
    {
        return ['scanned_at' => 'datetime'];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function scannedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'scanned_by');
    }

    protected static function newFactory(): ScannedDocumentFactory
    {
        return ScannedDocumentFactory::new();
    }
}
