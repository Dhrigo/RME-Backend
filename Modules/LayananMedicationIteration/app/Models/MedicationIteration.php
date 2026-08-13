<?php

namespace Modules\LayananMedicationIteration\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananPrescription\Models\Prescription;
use Modules\LayananMedicationIteration\Database\Factories\MedicationIterationFactory;

class MedicationIteration extends Model
{
    use HasFactory;

    protected $table = 'medication_iterations';

    public const STATUSS = ['pending', 'dispensed'];

    protected $fillable = [
        'prescription_id',
        'iteration_number',
        'quantity',
        'dispensed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'dispensed_at' => 'datetime',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    protected static function newFactory(): MedicationIterationFactory
    {
        return MedicationIterationFactory::new();
    }
}
