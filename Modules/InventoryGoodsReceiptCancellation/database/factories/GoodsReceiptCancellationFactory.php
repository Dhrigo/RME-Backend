<?php

namespace Modules\InventoryGoodsReceiptCancellation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryGoodsReceiptCancellation\Models\GoodsReceiptCancellation;

class GoodsReceiptCancellationFactory extends Factory
{
    protected $model = GoodsReceiptCancellation::class;

    public function definition(): array
    {
        return [
            'cancellation_number' => 'GRC-'.fake()->unique()->numerify('####-######'),
            'goods_receipt_id' => GoodsReceipt::factory(),
            'reason' => fake()->randomElement(['Salah input jumlah', 'Barang tidak sesuai pesanan', 'Duplikasi input penerimaan']),
            'cancelled_by' => null,
            'cancelled_at' => now(),
        ];
    }
}
