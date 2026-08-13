<?php

namespace Modules\MedicalRecordRadiologyResultSummaryItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordRadiologyResultSummary\Models\RadiologyResultSummary;
use Modules\MedicalRecordRadiologyResultSummaryItem\Database\Factories\RadiologyResultSummaryItemFactory;

class RadiologyResultSummaryItem extends Model
{
    use HasFactory;

    protected $table = 'radiology_result_summary_items';

    protected $fillable = [
        'summary_id',
        'exam_name',
        'finding',
        'impression',
        'performed_at',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function summary(): BelongsTo
    {
        return $this->belongsTo(RadiologyResultSummary::class, 'summary_id');
    }

    protected static function newFactory(): RadiologyResultSummaryItemFactory
    {
        return RadiologyResultSummaryItemFactory::new();
    }
}
