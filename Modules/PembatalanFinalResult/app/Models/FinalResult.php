<?php
namespace Modules\PembatalanFinalResult\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class FinalResult extends Model {
    use HasFactory;
    protected $table = 'final_result_cancellations';
    protected $fillable = ['visit_id', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        $year = now()->format('Y');
        $count = static::query()->where('cancellation_number', 'like', "FRC-{$year}-%")->count();
        return sprintf('FRC-%s-%06d', $year, $count + 1);
    }
    protected static function newFactory() {
        return \Modules\PembatalanFinalResult\Database\Factories\FinalResultFactory::new();
    }
}
