<?php

namespace Modules\LayananPrescriptionInitialReview\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionInitialReview\Database\Factories\PrescriptionInitialReviewFactory;

class PrescriptionInitialReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'reviewed_by',
        'reviewed_at',
        'is_appropriate',
        'issues_found',
        'recommendation',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'is_appropriate' => 'boolean',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescription\Models\Prescription::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'reviewed_by');
    }

    protected static function newFactory(): PrescriptionInitialReviewFactory
    {
        return PrescriptionInitialReviewFactory::new();
    }
}
