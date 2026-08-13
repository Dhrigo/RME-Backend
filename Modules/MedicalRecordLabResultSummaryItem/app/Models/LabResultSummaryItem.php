<?php

namespace Modules\MedicalRecordLabResultSummaryItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordLabResultSummary\Models\LabResultSummary;
use Modules\MedicalRecordLabResultSummaryItem\Database\Factories\LabResultSummaryItemFactory;

class LabResultSummaryItem extends Model
{
    use HasFactory;

    protected $table = 'lab_result_summary_items';

    protected $fillable = [
        'summary_id',
        'lab_test_name',
        'result_value',
        'unit',
        'reference_range',
        'flag',
        'tested_at',
    ];

    protected function casts(): array
    {
        return [
            'tested_at' => 'datetime',
        ];
    }

    public function summary(): BelongsTo
    {
        return $this->belongsTo(LabResultSummary::class, 'summary_id');
    }

    protected static function newFactory(): LabResultSummaryItemFactory
    {
        return LabResultSummaryItemFactory::new();
    }
}
