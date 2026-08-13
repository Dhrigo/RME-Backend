<?php

namespace Modules\PembayaranPackageInvoiceItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPackage\Models\Package;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPackageInvoiceItem\Models\PackageInvoiceItem;

class PackageInvoiceItemFactory extends Factory
{
    protected $model = PackageInvoiceItem::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 3);
        $unitPrice = fake()->randomFloat(2, 100000, 5000000);

        return [
            'invoice_id' => Invoice::factory(),
            'package_id' => Package::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $quantity * $unitPrice,
            'notes' => null,
        ];
    }
}
