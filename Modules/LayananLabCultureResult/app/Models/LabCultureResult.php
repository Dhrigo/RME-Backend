<?php

namespace Modules\LayananLabCultureResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabCultureResult\Database\Factories\LabCultureResultFactory;

class LabCultureResult extends Model
{
    use HasFactory;

    protected $table = 'lab_culture_results';

    public const RESULT_STATUSS = ['pending', 'positive', 'negative'];

    protected $fillable = [
        'lab_order_id',
        'specimen_type',
        'organism_found',
        'colony_count',
        'examined_at',
        'result_status',
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

    protected static function newFactory(): LabCultureResultFactory
    {
        return LabCultureResultFactory::new();
    }
}
