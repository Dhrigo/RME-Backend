<?php

namespace Modules\MedicalRecordRecordFileLoan\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordRecordFileLoan\Database\Factories\RecordFileLoanFactory;

class RecordFileLoan extends Model
{
    use HasFactory;

    protected $table = 'record_file_loans';

    protected $fillable = [
        'patient_id',
        'borrower_name',
        'borrower_unit',
        'purpose',
        'loaned_at',
        'due_at',
        'returned_at',
        'status',
    ];

    protected $casts = [
        'loaned_at' => 'datetime',
        'due_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    protected static function newFactory(): RecordFileLoanFactory
    {
        return RecordFileLoanFactory::new();
    }
}
