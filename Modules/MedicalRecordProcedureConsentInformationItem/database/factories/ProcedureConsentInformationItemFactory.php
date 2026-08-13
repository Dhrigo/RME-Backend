<?php

namespace Modules\MedicalRecordProcedureConsentInformationItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordProcedureConsentInformationItem\Models\ProcedureConsentInformationItem;

class ProcedureConsentInformationItemFactory extends Factory
{
    protected $model = ProcedureConsentInformationItem::class;

    public function definition(): array
    {
        return [
            'information_id' => \Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation::factory(),
            'item_name' => fake()->randomElement(['Diagnosis','Dasar Diagnosis','Tindakan Kedokteran','Indikasi Tindakan','Tata Cara','Tujuan','Risiko','Komplikasi','Prognosis','Alternatif & Risiko']),
            'is_explained' => true,
            'is_understood' => true,
        ];
    }
}
