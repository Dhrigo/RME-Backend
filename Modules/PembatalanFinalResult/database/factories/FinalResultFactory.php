<?php
namespace Modules\PembatalanFinalResult\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembatalanFinalResult\Models\FinalResult;
use Modules\PendaftaranVisit\Models\Visit;
class FinalResultFactory extends Factory {
    protected $model = FinalResult::class;
    public function definition(): array {
        return [
            'visit_id' => Visit::factory(),
            'cancellation_number' => $this->faker->unique()->numerify('FRC-##########'),
            'reason' => $this->faker->sentence(),
            'cancellation_date' => $this->faker->dateTime(),
            'requested_by' => $this->faker->name(),
            'status' => 'pending',
        ];
    }
}
