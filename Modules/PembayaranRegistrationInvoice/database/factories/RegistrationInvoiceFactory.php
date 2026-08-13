<?php

namespace Modules\PembayaranRegistrationInvoice\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranRegistrationInvoice\Models\RegistrationInvoice;
use Modules\PendaftaranRegistration\Models\Registration;

class RegistrationInvoiceFactory extends Factory
{
    protected $model = RegistrationInvoice::class;

    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'invoice_id' => Invoice::factory(),
            'invoice_category' => fake()->randomElement(RegistrationInvoice::CATEGORIES),
            'amount' => fake()->randomFloat(2, 25000, 500000),
            'notes' => null,
        ];
    }
}
