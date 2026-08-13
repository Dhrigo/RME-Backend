<?php

namespace Modules\MedicalRecordFamilyPlanningObstetrics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordFamilyPlanningObstetrics\Database\Factories\FamilyPlanningObstetricsFactory;

class FamilyPlanningObstetrics extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'family_planning_obstetrics';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'contraceptive_method',
        'installation_date',
        'removal_date',
        'side_effects',
        'action_taken',
        'next_visit_date',
    ];

    protected $casts = [
        'installation_date' => 'date',
        'removal_date' => 'date',
        'next_visit_date' => 'date',
    ];

    protected static function newFactory(): FamilyPlanningObstetricsFactory
    {
        return FamilyPlanningObstetricsFactory::new();
    }
}
