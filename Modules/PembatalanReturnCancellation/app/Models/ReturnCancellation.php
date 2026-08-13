<?php
namespace Modules\PembatalanReturnCancellation\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ReturnCancellation extends Model {
    use HasFactory;
    protected $fillable = ['return_id', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        $year = now()->format('Y');
        $count = static::query()->where('cancellation_number', 'like', "RCN-{$year}-%")->count();
        return sprintf('RCN-%s-%06d', $year, $count + 1);
    }
    protected static function newFactory() {
        return \Modules\PembatalanReturnCancellation\Database\Factories\ReturnCancellationFactory::new();
    }
}
