<?php

namespace Modules\LayananPathologyAnatomyResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananPathologyAnatomyResult\Database\Factories\PathologyAnatomyResultFactory;

class PathologyAnatomyResult extends Model
{
    use HasFactory;

    protected $table = 'pathology_anatomy_results';

    public const STATUSS = ['pending', 'final'];

    protected $fillable = [
        'visit_id',
        'patient_id',
        'specimen_description',
        'macroscopic_finding',
        'microscopic_finding',
        'diagnosis',
        'examined_by',
        'examined_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function examinedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'examined_by');
    }

    protected static function newFactory(): PathologyAnatomyResultFactory
    {
        return PathologyAnatomyResultFactory::new();
    }
}
