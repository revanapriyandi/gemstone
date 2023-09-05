<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::firstOrCreate([
            'app_name' => 'Gemstone',
            'app_slogan' => 'Top Up Game & Voucher',
            'app_url' => 'http://localhost:8000',
            'app_detail' => 'Gemstone - Top Up Game & Voucher termurah, terpercaya, dan aman legal 100% open 24 Jam dengan payment terlengkap Indonesia.',
            'footer_text' => '© 2023 Gemstone . All rights reserved.',
            'currency' => 'IDR',
            'country' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'markup_harga' => 15,
        ]);
    }
}
