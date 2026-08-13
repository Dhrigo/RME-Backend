<?php
namespace Modules\PembatalanMedicalRecordCancellation\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MedicalRecordCancellation extends Model {
    use HasFactory;
    protected $fillable = ['medical_record_id', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        $year = now()->format('Y');
        $count = static::query()->where('cancellation_number', 'like', "MRC-{$year}-%")->count();
        return sprintf('MRC-%s-%06d', $year, $count + 1);
    }
    protected static function newFactory() {
        return \Modules\PembatalanMedicalRecordCancellation\Database\Factories\MedicalRecordCancellationFactory::new();
    }
}
