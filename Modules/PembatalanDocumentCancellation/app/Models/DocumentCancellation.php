<?php
namespace Modules\PembatalanDocumentCancellation\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DocumentCancellation extends Model {
    use HasFactory;
    protected $table = 'document_cancellations';
    protected $fillable = ['document_id', 'document_type', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        $year = now()->format('Y');
        $count = static::query()->where('cancellation_number', 'like', "DCN-{$year}-%")->count();
        return sprintf('DCN-%s-%06d', $year, $count + 1);
    }
    protected static function newFactory() {
        return \Modules\PembatalanDocumentCancellation\Database\Factories\DocumentCancellationFactory::new();
    }
}
