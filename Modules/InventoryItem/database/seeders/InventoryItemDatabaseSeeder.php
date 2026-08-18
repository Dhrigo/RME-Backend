<?php

namespace Modules\InventoryItem\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\InventoryItem\Models\Item;

class InventoryItemDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['code' => 'OBT-001', 'name' => 'Paracetamol 500mg', 'category' => 'medicine', 'unit' => 'tablet', 'is_generic' => true],
            ['code' => 'OBT-002', 'name' => 'Amoxicillin 500mg', 'category' => 'medicine', 'unit' => 'kapsul', 'is_generic' => true],
            ['code' => 'OBT-003', 'name' => 'Omeprazole 20mg', 'category' => 'medicine', 'unit' => 'kapsul', 'is_generic' => true],
            ['code' => 'OBT-004', 'name' => 'Cetirizine 10mg', 'category' => 'medicine', 'unit' => 'tablet', 'is_generic' => true],
            ['code' => 'OBT-005', 'name' => 'Ibuprofen 400mg', 'category' => 'medicine', 'unit' => 'tablet', 'is_generic' => true],
            ['code' => 'OBT-006', 'name' => 'Amlodipine 5mg', 'category' => 'medicine', 'unit' => 'tablet', 'is_generic' => true],
            ['code' => 'OBT-007', 'name' => 'Metformin 500mg', 'category' => 'medicine', 'unit' => 'tablet', 'is_generic' => true],
            ['code' => 'OBT-008', 'name' => 'Salbutamol Inhaler', 'category' => 'medicine', 'unit' => 'botol', 'is_generic' => false],
            ['code' => 'OBT-009', 'name' => 'Vitamin B Complex', 'category' => 'medicine', 'unit' => 'tablet', 'is_generic' => false],
            ['code' => 'OBT-010', 'name' => 'Oralit', 'category' => 'medicine', 'unit' => 'sachet', 'is_generic' => false],
            ['code' => 'ALK-001', 'name' => 'Kasa Steril', 'category' => 'medical-supply', 'unit' => 'pcs', 'is_generic' => false],
            ['code' => 'ALK-002', 'name' => 'Alkohol Swab', 'category' => 'medical-supply', 'unit' => 'pcs', 'is_generic' => false],
            ['code' => 'ALK-003', 'name' => 'Sarung Tangan Medis', 'category' => 'medical-supply', 'unit' => 'pcs', 'is_generic' => false],
            ['code' => 'ALK-004', 'name' => 'Spuit 3cc', 'category' => 'medical-supply', 'unit' => 'pcs', 'is_generic' => false],
            ['code' => 'ALK-005', 'name' => 'Infus Set', 'category' => 'medical-supply', 'unit' => 'pcs', 'is_generic' => false],
        ];

        foreach ($items as $item) {
            Item::firstOrCreate(
                ['name' => $item['name']],
                [
                    'code' => $item['code'],
                    'category' => $item['category'],
                    'unit' => $item['unit'],
                    'is_generic' => $item['is_generic'],
                    'is_formulary' => true,
                    'stock_quantity' => 100,
                    'is_active' => true,
                ]
            );
        }
    }
}
