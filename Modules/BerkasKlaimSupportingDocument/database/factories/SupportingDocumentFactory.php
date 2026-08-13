<?php

namespace Modules\BerkasKlaimSupportingDocument\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimSupportingDocument\Models\SupportingDocument;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;

class SupportingDocumentFactory extends Factory
{
    protected $model = SupportingDocument::class;

    public function definition(): array
    {
        return [
            'claim_file_id' => ClaimFile::factory(),
            'document_type' => $this->faker->word(),
            'file_path' => $this->faker->filePath(),
            'uploaded_at' => $this->faker->dateTime(),
        ];
    }
}
