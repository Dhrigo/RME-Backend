<?php

namespace Modules\LayananLabMicroscopicResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabMicroscopicResult\Database\Factories\LabMicroscopicResultFactory;

class LabMicroscopicResult extends Model
{
    use HasFactory;

    protected $table = 'lab_microscopic_results';

    protected $fillable = [
        'lab_order_id',
        'specimen_type',
        'findings',
        'examined_by',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    public function examinedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'examined_by');
    }

    protected static function newFactory(): LabMicroscopicResultFactory
    {
        return LabMicroscopicResultFactory::new();
    }
}
