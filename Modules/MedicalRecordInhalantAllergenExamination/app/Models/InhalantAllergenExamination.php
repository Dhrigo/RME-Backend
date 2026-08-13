<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordInhalantAllergenExamination\Database\Factories\InhalantAllergenExaminationFactory;

class InhalantAllergenExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inhalant_allergen_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'allergen_name',
        'reaction_grade',
        'wheal_diameter_mm',
        'erythema_diameter_mm',
        'interpretation',
        'examined_at',
    ];

    protected $casts = [
        'wheal_diameter_mm' => 'float',
        'erythema_diameter_mm' => 'float',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): InhalantAllergenExaminationFactory
    {
        return InhalantAllergenExaminationFactory::new();
    }
}
