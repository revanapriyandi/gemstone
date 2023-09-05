<?php

namespace App\Console\Commands;

use App\Models\Produk;
use App\Models\Settings;
use App\Models\ProviderProduk;
use Illuminate\Console\Command;

class UpdateMarkupHargaJual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:harga-jual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update markup harga jual produk';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $setting = Settings::find(1);
        $markupHarga = $setting->markup_harga;

        $provider = ProviderProduk::where('name', 'Vip Reseller')->first();
        $level = $provider->level;

        $produkList = Produk::all();

        foreach ($produkList as $item) {
            $harga = json_decode($item->harga);
            if (property_exists($harga, $level)) {
                $hargaLevel = $harga->$level;
                $hargaJual = $hargaLevel + ($hargaLevel * ($markupHarga / 100));

                $item->update([
                    'harga_jual' => $hargaJual,
                ]);
            }
        }
    }
}
