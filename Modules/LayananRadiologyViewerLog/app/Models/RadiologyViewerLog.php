<?php

namespace Modules\LayananRadiologyViewerLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananRadiologyViewerLog\Database\Factories\RadiologyViewerLogFactory;

class RadiologyViewerLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'accession_number',
        'viewed_by',
        'viewed_at',
        'ip_address',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'viewed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function viewedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'viewed_by');
    }

    protected static function newFactory(): RadiologyViewerLogFactory
    {
        return RadiologyViewerLogFactory::new();
    }
}
