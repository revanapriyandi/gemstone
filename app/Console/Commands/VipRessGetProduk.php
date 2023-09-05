<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Produk;
use App\Helpers\Helper;
use App\Models\TypeProduk;
use App\Models\BrandProduk;
use Illuminate\Support\Str;
use App\Models\KategoriProduk;
use App\Models\ProviderProduk;
use Illuminate\Console\Command;
use App\Http\Controllers\Provider\VipResController;
use App\Models\Settings;

class VipRessGetProduk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vipress:getproduk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store updated products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching level user from vipreseller');
        $this->getProfileInformation();

        $this->info('Fetching products from vipreseller');

        $this->getProduk('prepaid');
        $this->info('Prepaid products updated');

        // $this->getProduk('postpaid');
        // $this->info('Postpaid products updated');

        $this->getProduk('social-media');
        $this->info('Social media products updated');

        $this->getProduk('game-feature');
        $this->info('Game feature products updated');
    }

    private function getProfileInformation()
    {
        $con = new VipResController;
        $profile = $con->profile();
        if ($profile['result'] == true) {
            $data = $profile['data'];
            $provider = ProviderProduk::where('name', 'Vip Reseller')->first();
            $provider->level = strtolower($data['level']);
            $provider->update();
        }
    }

    private function getProduk($type)
    {
        $con = new VipResController;

        $data = $con->pricesList($type);

        try {
            if ($data['result'] == true) {
                $existingProductCodes = Produk::where('prepost', $type)->pluck('kode')->toArray();
                $newProductCodes = [];

                foreach ($data['data'] as $item) {
                    $typeProduk = $this->updateOrCreateTypeProduk($item, $type);
                    $kategori = $this->updateOrCreateKategori($item, $typeProduk, $type);
                    $brand = $this->updateOrCreateBrand($item, $typeProduk, $kategori, $type);
                    $produk = $this->updateOrCreateProduk($item, $brand, $kategori, $typeProduk, $type);

                    $newProductCodes[] = $produk->kode;
                }

                // Hapus produk yang ada di database tetapi tidak ada di data baru dari API
                $productsToDelete = array_diff($existingProductCodes, $newProductCodes);
                Produk::whereIn('kode', $productsToDelete)->delete();
            } else {
                $this->error($data['message']);
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }



    private function updateOrCreateBrand($data, $typeProduk, $kategori, $type)
    {
        $brandName  = '';
        if ($type == 'social-media') {
            $brandName = Helper::checkItemName($data['name']);
        } elseif ($type == 'game-feature') {
            $cekGame = Helper::checkItemName($data['game']);
            $brandName = $cekGame ?: $data['game'];
        } else {
            $brandName = $data['brand'];
        }
        $brandCode = Str::slug($brandName);

        return BrandProduk::firstOrCreate(
            [
                'kode' => $brandCode,
            ],
            [
                'kode' => $brandCode,
                'name' => $brandName,
                'slug' => Str::slug($brandName),
                'meta_title' => $brandName,
                'type_id' => $typeProduk->id,
                'kategori_id' => $kategori->id,
                'prepost' => $type,
            ]
        );
    }


    private function updateOrCreateKategori($data, $typeProduk, $type)
    {
        $kategoriName = '';
        if ($type == 'game-feature') {
            $kategoriName = Helper::isVoucher($data['name']) ?: 'Game';
        } else {
            $kategoriName = $data['category'];
        }
        $kategoriCode = Str::slug($kategoriName);
        return KategoriProduk::firstOrCreate(
            [
                'slug' => $kategoriCode,
            ],
            [
                'slug' => $kategoriCode,
                'name' => $kategoriName,
                'type_id' => $typeProduk->id
            ]
        );
    }

    private function updateOrCreateTypeProduk($data, $typeData)
    {
        $allowedTypes = ['social-media', 'game-feature'];
        $selectedType = in_array($typeData, $allowedTypes) ? $typeData : $data['type'];

        $typeCode = Str::slug($selectedType);
        $cleanedType = Helper::cleanAndFormatType($selectedType);

        $type = TypeProduk::firstOrCreate(
            [
                'slug' => $typeCode,
            ],
            [
                'slug' => $typeCode,
                'name' => $cleanedType,
                'meta_title' => $cleanedType,
            ]
        );

        return $type;
    }



    private function updateOrCreateProduk($data, $brand, $kategori, $type, $typeData)
    {
        $produkCode = '';
        $cekName = $typeData == 'social-media' ? true : false;
        if ($cekName) {
            $produkCode = $data['id'];
        } else {
            $produkCode = $data['code'];
        }
        $maintenance = null;
        if ($typeData == 'prepaid') {
            $maintenance = explode(' - ', $data['maintenace']);
        }

        $provider = ProviderProduk::where('name', 'Vip Reseller')->first();
        $setting = Settings::where('id', '1')->first();
        $price = $data['price'];
        $hargaJual = $price[$provider->level] + ($price[$provider->level] * $setting->markup_harga / 100);
        return Produk::updateOrCreate(
            [
                'kode' => $produkCode,
            ],
            [
                'kode' => $produkCode,
                'name' => $data['name'],
                'provider_produk_id' => ProviderProduk::where('slug', 'vip-reseller')->first()->id,
                'brand_produk_id' => $brand->id,
                'kategori_produk_id' => $kategori->id,
                'type_produk_id' => $type ? $type->id : null,
                'harga' => json_encode($data['price']),
                'markup_harga' => $setting->markup_harga,
                'harga_jual' => $hargaJual,
                'multi_trx' => $typeData == 'prepaid' ? $data['multi_trx'] : false,
                'status' => $data['status'] == 'empty' ? false : true,
                'maintenance_start' => $maintenance ? $maintenance[0] : null,
                'maintenance_end' => $maintenance ? $maintenance[1] : null,
                'prepost' => $typeData,
                'note' => $typeData == 'game-feature' ? null : $data['note'],
                'min_nominal' => $typeData == 'social-media' ? $data['min'] : null,
                'max_nominal' => $typeData == 'social-media' ? $data['max'] : null,
                'server' => $typeData == 'game-feature' ? $data['server'] : null,
            ]
        );
    }
}
