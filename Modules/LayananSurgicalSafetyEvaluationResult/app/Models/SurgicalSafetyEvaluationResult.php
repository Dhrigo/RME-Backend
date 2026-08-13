<?php

namespace Modules\LayananSurgicalSafetyEvaluationResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralOperatingRoom\Models\OperatingRoom;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananSurgicalSafetyEvaluationResult\Database\Factories\SurgicalSafetyEvaluationResultFactory;

class SurgicalSafetyEvaluationResult extends Model
{
    use HasFactory;

    protected $table = 'surgical_safety_evaluation_results';

    protected $fillable = [
        'visit_id',
        'operating_room_id',
        'evaluator_id',
        'checklist_score',
        'compliant',
        'evaluated_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'compliant' => 'boolean',
            'evaluated_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function operatingRoom(): BelongsTo
    {
        return $this->belongsTo(OperatingRoom::class, 'operating_room_id');
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'evaluator_id');
    }

    protected static function newFactory(): SurgicalSafetyEvaluationResultFactory
    {
        return SurgicalSafetyEvaluationResultFactory::new();
    }
}
