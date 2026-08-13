<?php

namespace Modules\GeneralEmployeePhoto\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralEmployeePhoto\Database\Factories\EmployeePhotoFactory;

class EmployeePhoto extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'file_path', 'taken_at'];

    protected function casts(): array
    {
        return ['taken_at' => 'datetime'];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): EmployeePhotoFactory
    {
        return EmployeePhotoFactory::new();
    }
}
