<?php

namespace Modules\LayananLabResultNote\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\Auth\Models\User;
use \Modules\LayananLabResult\Models\LabResult;
use Modules\LayananLabResultNote\Database\Factories\LabResultNoteFactory;

class LabResultNote extends Model
{
    use HasFactory;

    protected $table = 'lab_result_notes';

    protected $fillable = [
        'lab_result_id',
        'note',
        'created_by',
    ];

    public function labResult(): BelongsTo
    {
        return $this->belongsTo(LabResult::class, 'lab_result_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): LabResultNoteFactory
    {
        return LabResultNoteFactory::new();
    }
}
