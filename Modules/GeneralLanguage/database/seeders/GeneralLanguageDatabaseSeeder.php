<?php

namespace Modules\GeneralLanguage\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralLanguage\Models\Language;

class GeneralLanguageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Bahasa Indonesia', 'code' => 'IND'],
            ['name' => 'Bahasa Jawa', 'code' => 'JAV'],
            ['name' => 'Bahasa Sunda', 'code' => 'SUN'],
            ['name' => 'Bahasa Batak', 'code' => 'BTK'],
            ['name' => 'Bahasa Minang', 'code' => 'MIN'],
            ['name' => 'Bahasa Bugis', 'code' => 'BUG'],
            ['name' => 'Bahasa Bali', 'code' => 'BAN'],
            ['name' => 'Bahasa Madura', 'code' => 'MAD'],
            ['name' => 'Bahasa Banjar', 'code' => 'BJN'],
            ['name' => 'Bahasa Inggris', 'code' => 'ENG'],
        ];

        foreach ($items as $item) {
            Language::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
