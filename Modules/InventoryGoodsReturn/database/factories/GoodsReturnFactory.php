<?php

namespace Modules\InventoryGoodsReturn\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;
use Modules\InventorySupplier\Models\Supplier;

class GoodsReturnFactory extends Factory
{
    protected $model = GoodsReturn::class;

    public function definition(): array
    {
        return [
            'return_number' => 'RTN-'.fake()->unique()->numerify('####-######'),
            'supplier_id' => Supplier::factory(),
            'returned_by' => User::factory(),
            'returned_at' => now(),
            'reason' => fake()->randomElement(['Barang rusak', 'Kadaluarsa', 'Salah kirim dari supplier']),
            'status' => 'pending',
        ];
    }
}
