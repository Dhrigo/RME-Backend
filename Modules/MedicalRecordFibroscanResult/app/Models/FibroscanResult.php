<?php

namespace Modules\MedicalRecordFibroscanResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFibroscanResult\Database\Factories\FibroscanResultFactory;

class FibroscanResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'examination_date',
        'liver_stiffness_kpa',
        'cap_score',
        'fibrosis_stage',
        'examined_by',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'examination_date' => 'date',
            'liver_stiffness_kpa' => 'decimal:2',
            'cap_score' => 'decimal:2',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function examinedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'examined_by');
    }

    protected static function newFactory(): FibroscanResultFactory
    {
        return FibroscanResultFactory::new();
    }
}
