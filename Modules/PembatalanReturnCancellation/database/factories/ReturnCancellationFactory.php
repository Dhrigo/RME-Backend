<?php
namespace Modules\PembatalanReturnCancellation\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembatalanReturnCancellation\Models\ReturnCancellation;
class ReturnCancellationFactory extends Factory {
    protected $model = ReturnCancellation::class;
    public function definition(): array {
        return [
            'return_id' => $this->faker->uuid(),
            'cancellation_number' => $this->faker->unique()->numerify('RCN-##########'),
            'reason' => $this->faker->sentence(),
            'cancellation_date' => $this->faker->dateTime(),
            'requested_by' => $this->faker->name(),
            'status' => 'pending',
        ];
    }
}
