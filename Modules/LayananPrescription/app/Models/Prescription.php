<?php

namespace Modules\LayananPrescription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Database\Factories\PrescriptionFactory;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PendaftaranVisit\Models\Visit;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_number',
        'visit_id',
        'diagnosis_id',
        'prescribed_by',
        'prescribed_at',
        'weight_kg',
        'height_cm',
        'has_drug_allergy',
        'is_pregnant',
        'is_breastfeeding',
        'is_discharge_prescription',
        'is_emergency',
        'notes',
        'created_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'prescribed_at' => 'datetime',
            'weight_kg' => 'decimal:2',
            'height_cm' => 'decimal:2',
            'has_drug_allergy' => 'boolean',
            'is_pregnant' => 'boolean',
            'is_breastfeeding' => 'boolean',
            'is_discharge_prescription' => 'boolean',
            'is_emergency' => 'boolean',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function prescribedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'prescribed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    /**
     * Format: RX-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generatePrescriptionNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('prescription_number', 'like', "RX-{$year}-%")->count();

        return sprintf('RX-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): PrescriptionFactory
    {
        return PrescriptionFactory::new();
    }
}
