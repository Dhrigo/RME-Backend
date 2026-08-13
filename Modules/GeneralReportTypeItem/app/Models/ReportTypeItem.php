<?php

namespace Modules\GeneralReportTypeItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralReportType\Models\ReportType;
use Modules\GeneralReportTypeItem\Database\Factories\ReportTypeItemFactory;

class ReportTypeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_type_id',
        'name',
        'code',
        'sequence',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function reportType(): BelongsTo
    {
        return $this->belongsTo(ReportType::class);
    }

    protected static function newFactory(): ReportTypeItemFactory
    {
        return ReportTypeItemFactory::new();
    }
}
