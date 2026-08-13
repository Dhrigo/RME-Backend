<?php

namespace Modules\LayananPathologyImmunofluorescenceResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;
use Modules\LayananPathologyImmunofluorescenceResult\Database\Factories\PathologyImmunofluorescenceResultFactory;

class PathologyImmunofluorescenceResult extends Model
{
    use HasFactory;

    protected $table = 'pathology_immunofluorescence_results';

    protected $fillable = [
        'pathology_anatomy_result_id',
        'marker',
        'result',
        'intensity',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function pathologyAnatomyResult(): BelongsTo
    {
        return $this->belongsTo(PathologyAnatomyResult::class, 'pathology_anatomy_result_id');
    }

    protected static function newFactory(): PathologyImmunofluorescenceResultFactory
    {
        return PathologyImmunofluorescenceResultFactory::new();
    }
}
