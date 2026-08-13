<?php

namespace Modules\LayananPathologyMolecularResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;
use Modules\LayananPathologyMolecularResult\Database\Factories\PathologyMolecularResultFactory;

class PathologyMolecularResult extends Model
{
    use HasFactory;

    protected $table = 'pathology_molecular_results';

    protected $fillable = [
        'pathology_anatomy_result_id',
        'test_name',
        'result',
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

    protected static function newFactory(): PathologyMolecularResultFactory
    {
        return PathologyMolecularResultFactory::new();
    }
}
