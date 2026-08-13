<?php

namespace Modules\MedicalRecordRehabilitationProcedureExaminationItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Database\Factories\RehabilitationProcedureExaminationItemFactory;

class RehabilitationProcedureExaminationItem extends Model
{
    use HasFactory;

    protected $table = 'rehabilitation_procedure_examination_items';

    protected $fillable = [
        'rehabilitation_procedure_examination_id',
        'step_name',
        'duration_minutes',
        'result',
        'sequence',
    ];


    protected static function newFactory(): RehabilitationProcedureExaminationItemFactory
    {
        return RehabilitationProcedureExaminationItemFactory::new();
    }
}
