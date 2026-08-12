<?php

namespace Modules\GeneralService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralService\Database\Factories\ServiceFactory;
use Modules\GeneralServiceTariff\Models\ServiceTariff;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'category', 'type_id', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function tariffs(): HasMany
    {
        return $this->hasMany(ServiceTariff::class);
    }

    /**
     * Currently effective tariff (latest by effective_date that isn't in the future).
     */
    public function currentTariff(): ?ServiceTariff
    {
        return $this->tariffs()
            ->where('is_active', true)
            ->where('effective_date', '<=', now())
            ->orderByDesc('effective_date')
            ->first();
    }

    protected static function newFactory(): ServiceFactory
    {
        return ServiceFactory::new();
    }
}
