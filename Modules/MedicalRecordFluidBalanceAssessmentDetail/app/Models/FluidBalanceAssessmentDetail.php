<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Database\Factories\FluidBalanceAssessmentDetailFactory;

class FluidBalanceAssessmentDetail extends Model
{
    use HasFactory;

    protected $table = 'fluid_balance_assessment_details';

    protected $fillable = [
        'fluid_balance_assessment_id',
        'type',
        'category',
        'amount_ml',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    protected static function newFactory(): FluidBalanceAssessmentDetailFactory
    {
        return FluidBalanceAssessmentDetailFactory::new();
    }
}
