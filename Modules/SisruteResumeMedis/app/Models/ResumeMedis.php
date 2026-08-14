<?php

namespace Modules\SisruteResumeMedis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SisruteResumeMedis\Database\Factories\ResumeMedisFactory;

/**
 * Local ledger of Resume Medis exchanges via SISRUTE's ResumeMedis-v1 API
 * (GET/POST /resumemedis/resume - confirmed live,
 * kemkes_research_findings_part2.md section 1.5). Body schema was not
 * published beyond the resource description, so payload/response are kept
 * as raw JSON rather than invented columns.
 */
class ResumeMedis extends Model
{
    use HasFactory;

    protected $fillable = [
        'payload',
        'response',
        'status',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'response' => 'array',
        ];
    }

    protected static function newFactory(): ResumeMedisFactory
    {
        return ResumeMedisFactory::new();
    }
}
