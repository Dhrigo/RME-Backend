<?php

namespace Modules\MedicalRecordClinicalNote\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordClinicalNote\Database\Factories\ClinicalNoteFactory;
use Modules\PendaftaranVisit\Models\Visit;

class ClinicalNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'recorded_at',
        'subjective',
        'objective',
        'assessment',
        'planning',
        'instructions',
        'note_type',
        'author_id',
        'sub_division',
        'has_discharge_plan',
        'discharge_plan_date',
        'created_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
            'has_discharge_plan' => 'boolean',
            'discharge_plan_date' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'author_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): ClinicalNoteFactory
    {
        return ClinicalNoteFactory::new();
    }
}
