<?php

namespace Modules\LayananRadiologyResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyResult\Database\Factories\RadiologyResultFactory;

class RadiologyResult extends Model
{
    use HasFactory;

    protected $table = 'radiology_results';

    public const STATUSS = ['pending', 'final'];

    protected $fillable = [
        'radiology_order_id',
        'findings',
        'impression',
        'radiologist_id',
        'examined_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function radiologyOrder(): BelongsTo
    {
        return $this->belongsTo(RadiologyOrder::class, 'radiology_order_id');
    }

    public function radiologist(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'radiologist_id');
    }

    protected static function newFactory(): RadiologyResultFactory
    {
        return RadiologyResultFactory::new();
    }
}
