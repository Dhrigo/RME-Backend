<?php

namespace Modules\BerkasKlaimClaimFile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimFile extends Model
{
    use HasFactory;

    protected $fillable = ['visit_id', 'invoice_id', 'claim_number', 'submitted_at', 'status'];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public static function generateClaimNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('claim_number', 'like', "CLM-{$year}-%")->count();
        return sprintf('CLM-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory()
    {
        return \Modules\BerkasKlaimClaimFile\Database\Factories\ClaimFileFactory::new();
    }
}
