<?php

namespace Modules\MedicalRecordFluidBalanceAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordFluidBalanceAssessment\Database\Factories\FluidBalanceAssessmentFactory;

class FluidBalanceAssessment extends Model
{
    use HasFactory;

    protected $table = 'fluid_balance_assessments';

    protected $fillable = [
        'visit_id',
        'shift',
        'assessed_at',
        'total_intake_ml',
        'total_output_ml',
        'balance_ml',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): FluidBalanceAssessmentFactory
    {
        return FluidBalanceAssessmentFactory::new();
    }
}
