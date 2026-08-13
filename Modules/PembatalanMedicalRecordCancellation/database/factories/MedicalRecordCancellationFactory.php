<?php
namespace Modules\PembatalanMedicalRecordCancellation\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembatalanMedicalRecordCancellation\Models\MedicalRecordCancellation;
class MedicalRecordCancellationFactory extends Factory {
    protected $model = MedicalRecordCancellation::class;
    public function definition(): array {
        return [
            'medical_record_id' => $this->faker->uuid(),
            'cancellation_number' => $this->faker->unique()->numerify('MRC-##########'),
            'reason' => $this->faker->sentence(),
            'cancellation_date' => $this->faker->dateTime(),
            'requested_by' => $this->faker->name(),
            'status' => 'pending',
        ];
    }
}
