<?php

namespace Modules\SystemLicenseGuard\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenseStatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [
                'has_license' => false,
                'status' => 'unlicensed',
                'message' => 'No active license found.',
            ];
        }

        $now = now();
        $daysRemaining = $this->valid_until ? (int) $now->diffInDays($this->valid_until, false) : 0;

        return [
            'has_license' => true,
            'instance_id' => $this->instance_id,
            'client_name' => $this->client_name,
            'client_code' => $this->client_code,
            'tier' => $this->tier,
            'status' => $this->status,
            'issued_at' => $this->issued_at?->toIso8601String(),
            'valid_until' => $this->valid_until?->toIso8601String(),
            'days_remaining' => max(0, $daysRemaining),
            'is_expired' => $this->valid_until ? $now->greaterThan($this->valid_until) : true,
            'last_synced_at' => $this->last_synced_at?->toIso8601String(),
            'max_users' => $this->max_users,
            'allowed_modules' => $this->allowed_modules ?? [],
            'hardware_id' => $this->hardware_id,
        ];
    }
}
