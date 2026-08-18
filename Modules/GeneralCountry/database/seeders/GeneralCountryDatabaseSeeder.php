<?php

namespace Modules\GeneralCountry\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralCountry\Models\Country;

class GeneralCountryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Malaysia', 'code' => 'MY'],
            ['name' => 'Singapura', 'code' => 'SG'],
            ['name' => 'Brunei Darussalam', 'code' => 'BN'],
            ['name' => 'Thailand', 'code' => 'TH'],
            ['name' => 'Filipina', 'code' => 'PH'],
            ['name' => 'Vietnam', 'code' => 'VN'],
            ['name' => 'Myanmar', 'code' => 'MM'],
            ['name' => 'Kamboja', 'code' => 'KH'],
            ['name' => 'Laos', 'code' => 'LA'],
            ['name' => 'Timor Leste', 'code' => 'TL'],
            ['name' => 'Jepang', 'code' => 'JP'],
            ['name' => 'Korea Selatan', 'code' => 'KR'],
            ['name' => 'Tiongkok', 'code' => 'CN'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Arab Saudi', 'code' => 'SA'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Amerika Serikat', 'code' => 'US'],
            ['name' => 'Inggris', 'code' => 'GB'],
            ['name' => 'Jerman', 'code' => 'DE'],
        ];

        foreach ($items as $item) {
            Country::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
