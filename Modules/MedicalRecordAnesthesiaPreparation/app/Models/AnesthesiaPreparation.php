<?php

namespace Modules\MedicalRecordAnesthesiaPreparation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordAnesthesiaPreparation\Database\Factories\AnesthesiaPreparationFactory;

class AnesthesiaPreparation extends Model
{
    use HasFactory;

    protected $table = 'anesthesia_preparations';

    protected $fillable = [
        'visit_id',
        'prepared_by',
        'created_by',
        'fasting_hours',
        'allergy_checked',
        'mallampati_score',
        'consent_confirmed',
        'equipment_checklist',
        'prepared_at',
    ];

    protected function casts(): array
    {
        return [
            'allergy_checked' => 'boolean',
            'consent_confirmed' => 'boolean',
            'prepared_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'prepared_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): AnesthesiaPreparationFactory
    {
        return AnesthesiaPreparationFactory::new();
    }
}
