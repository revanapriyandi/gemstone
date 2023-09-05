<?php

namespace Database\Seeders;

use App\Models\ProviderProduk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Vip Reseller',
                'logo' => 'https://vip-reseller.co.id/library/assets/images/ico/favicon.ico',
                'slug' => 'vip-reseller',
                'deskripsi' => 'Vip Reseller adalah platform yang menyediakan layanan pembelian pulsa, paket data, token listrik, voucher game, dan lain-lain.',
                'status' => true,
                'app_id' => 'VIP-RES-000000',
                'api_key' => '1234567890',
            ],
            [
                'name' => 'Digiflazz',
                'logo' => 'https://digiflazz.com/images/logo/main.png',
                'slug' => 'digiflazz',
                'deskripsi' => 'Digiflazz adalah marketplace pulsa dan produk digital pertama di Indonesia. Digiflazz menyediakan berbagai macam produk digital mulai dari pulsa semua operator.',
                'status' => true,
                'app_id' => '1234567890',
                'api_key' => '1234567890',
            ],
        ];

        foreach ($data as $providerData) {
            ProviderProduk::firstOrCreate(
                ['name' => $providerData['name']],
                $providerData
            );
        }
    }
}
