<?php

namespace Modules\GeneralGuarantorSubspecialty\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralGuarantorSubspecialty\Models\GuarantorSubspecialty;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorSubspecialtyFactory extends Factory
{
    protected $model = GuarantorSubspecialty::class;

    public function definition(): array
    {
        return [
            'guarantor_id' => Guarantor::factory(),
            'subspecialty_name' => fake()->randomElement([
                'Bedah Onkologi', 'Jantung dan Pembuluh Darah', 'Ginjal Hipertensi',
                'Fetomaternal', 'Bedah Saraf', 'Hematologi Onkologi Medik',
            ]),
            'is_covered' => true,
            'coverage_note' => null,
        ];
    }
}
