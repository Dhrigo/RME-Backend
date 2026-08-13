<?php

namespace Modules\LayananLabMicroscopicResultItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabMicroscopicResult\Models\LabMicroscopicResult;
use Modules\LayananLabMicroscopicResultItem\Database\Factories\LabMicroscopicResultItemFactory;

class LabMicroscopicResultItem extends Model
{
    use HasFactory;

    protected $table = 'lab_microscopic_result_items';

    protected $fillable = [
        'lab_microscopic_result_id',
        'parameter_name',
        'value',
    ];

    public function labMicroscopicResult(): BelongsTo
    {
        return $this->belongsTo(LabMicroscopicResult::class, 'lab_microscopic_result_id');
    }

    protected static function newFactory(): LabMicroscopicResultItemFactory
    {
        return LabMicroscopicResultItemFactory::new();
    }
}
