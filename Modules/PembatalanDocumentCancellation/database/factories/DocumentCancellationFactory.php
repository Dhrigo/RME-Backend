<?php
namespace Modules\PembatalanDocumentCancellation\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembatalanDocumentCancellation\Models\DocumentCancellation;
class DocumentCancellationFactory extends Factory {
    protected $model = DocumentCancellation::class;
    public function definition(): array {
        return [
            'document_id' => $this->faker->uuid(),
            'document_type' => 'Invoice',
            'cancellation_number' => $this->faker->unique()->numerify('DCN-##########'),
            'reason' => $this->faker->sentence(),
            'cancellation_date' => $this->faker->dateTime(),
            'requested_by' => $this->faker->name(),
            'status' => 'pending',
        ];
    }
}
