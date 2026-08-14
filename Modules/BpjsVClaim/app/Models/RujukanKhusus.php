<?php

namespace Modules\BpjsVClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\BpjsVClaim\Database\Factories\RujukanKhususFactory;

class RujukanKhusus extends Model
{
    use HasFactory;

    protected $table = 'rujukan_khusus';

    protected $fillable = [
        'no_rujukan_asal',
        'diagnosa',
        'kode_prosedur',
        'no_rujukan_khusus',
        'local_status',
        'bpjs_response',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'bpjs_response' => 'array',
        ];
    }

    protected static function newFactory(): RujukanKhususFactory
    {
        return RujukanKhususFactory::new();
    }
}
