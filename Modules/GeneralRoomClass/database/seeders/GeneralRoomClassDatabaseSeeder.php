<?php

namespace Modules\GeneralRoomClass\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralRoomClass\Models\RoomClass;

class GeneralRoomClassDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'VIP', 'code' => 'VIP'],
            ['name' => 'Kelas 1', 'code' => 'K1'],
            ['name' => 'Kelas 2', 'code' => 'K2'],
            ['name' => 'Kelas 3', 'code' => 'K3'],
            ['name' => 'VVIP', 'code' => 'VVIP'],
            ['name' => 'Non Kelas', 'code' => 'NON'],
        ];

        foreach ($items as $item) {
            RoomClass::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
