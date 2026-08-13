<?php

namespace Modules\GeneralExaminationGroupMapping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralExaminationGroup\Models\ExaminationGroup;
use Modules\GeneralExaminationGroupMapping\Database\Factories\ExaminationGroupMappingFactory;

class ExaminationGroupMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_group_id',
        'mapping_category',
        'external_code',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function examinationGroup(): BelongsTo
    {
        return $this->belongsTo(ExaminationGroup::class);
    }

    protected static function newFactory(): ExaminationGroupMappingFactory
    {
        return ExaminationGroupMappingFactory::new();
    }
}
