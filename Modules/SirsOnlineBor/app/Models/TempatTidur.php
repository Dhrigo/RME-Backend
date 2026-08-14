<?php

namespace Modules\SirsOnlineBor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SirsOnlineBor\Database\Factories\TempatTidurFactory;

/**
 * Local record of bed-availability rows pushed to SIRANAP / RS Online
 * Fasyankes endpoint. Fields ported EXACTLY from the live-verified payload
 * in kemkes_research_findings_part3.md Task 1 - not renamed/summarized.
 */
class TempatTidur extends Model
{
    use HasFactory;

    protected $table = 'sirs_online_bor_tempat_tidurs';

    protected $fillable = [
        'id_tt',
        'ruang',
        'jumlah_ruang',
        'jumlah',
        'terpakai',
        'terpakai_suspek',
        'terpakai_konfirmasi',
        'antrian',
        'prepare',
        'prepare_plan',
        'covid',
        'terpakai_dbd',
        'terpakai_dbd_anak',
        'jumlah_dbd',
        'response',
        'status',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'response' => 'array',
        ];
    }

    protected static function newFactory(): TempatTidurFactory
    {
        return TempatTidurFactory::new();
    }
}
