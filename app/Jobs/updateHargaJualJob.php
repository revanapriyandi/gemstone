<?php

namespace App\Jobs;

use App\Models\Produk;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use App\Models\ProviderProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class updateHargaJualJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $markup_harga;
    public function __construct($markup_harga)
    {
        $this->markup_harga = $markup_harga;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = Settings::findOrFail(1);
        $data->markup_harga = $this->markup_harga;
        $data->update();

        DB::table('produks')->update(['markup_harga' => $this->markup_harga]);

        $provider = ProviderProduk::where('name', 'Vip Reseller')->first();
        $level = $provider->level;

        $produkList = Produk::all();

        foreach ($produkList as $item) {
            $harga = json_decode($item->harga);
            if (property_exists($harga, $level)) {
                $hargaLevel = $harga->$level;
                $hargaJual = $hargaLevel + ($hargaLevel * ($this->markup_harga / 100));

                $item->update([
                    'harga_jual' => $hargaJual,
                ]);
            }
        }
    }
}
