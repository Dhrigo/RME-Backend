<?php

namespace Modules\GeneralGuarantorParticipantType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralGuarantorParticipantType\Models\GuarantorParticipantType;

class GuarantorParticipantTypeFactory extends Factory
{
    protected $model = GuarantorParticipantType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['PBI APBN', 'PBI APBD', 'Pekerja Penerima Upah', 'Pekerja Bukan Penerima Upah', 'Bukan Pekerja', 'Peserta Mandiri']),
            'code' => fake()->unique()->lexify('????'),
            'payer_type' => 'bpjs',
            'requires_verification' => true,
            'is_active' => true,
        ];
    }
}
