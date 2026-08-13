<?php

namespace Modules\PendaftaranHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranHistory\Models\RegistrationHistory;
use Modules\PendaftaranRegistration\Models\Registration;

class RegistrationHistoryFactory extends Factory
{
    protected $model = RegistrationHistory::class;

    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'old_status' => 'pending',
            'new_status' => 'confirmed',
            'changed_by' => null,
            'changed_at' => now(),
            'notes' => null,
        ];
    }
}
