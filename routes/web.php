<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Provider\ServerGame;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Service\OpenAiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormOrderBrandController;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Provider\VipResController;

Auth::routes(['verify' => true]);

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/testorder', function () {
    $con = new VipResController;
    $data = $con->orderPrepaid('085156456036', 'BYU10');
    return $data;
});
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/getBrandsByCategory/{id}', [HomeController::class, 'getBrandsByCategory'])->name('getBrandsByCategory');
Route::get('/{slug}', [PurchaseController::class, 'purchase'])->name('purchase');
Route::get('/checkout/{brand}/{produk}/{payment}', [PurchaseController::class, 'checkout'])->name('purchase.checkout');
Route::post('/purchase/order', [PurchaseController::class, 'order'])->name('purchase.order');
Route::get('/checkout/{id}/charge', [PaymentsController::class, 'Charge'])->name('payment.charge');

Route::get('/get/search', [HomeController::class, 'searchHome'])->name('searchHome');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/fetch-produk', [ProdukController::class, 'fetchProduk'])->name('fetch-produk');
    Route::post('/update-markup-harga', [ProdukController::class, 'updateMarkupHarga'])->name('update-markup-harga');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/fetch-kategori', [KategoriController::class, 'fetchKategori'])->name('fetch-kategori');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/{id}/update/status', [KategoriController::class, 'updateStatus'])->name('kategori.update.status');
    Route::post('/kategori/{id}/update/pin', [KategoriController::class, 'updatePin'])->name('kategori.update.pin');
    Route::delete('/kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/{id}/update', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/fetch-brand', [BrandController::class, 'fetchBrand'])->name('fetch-brand');
    Route::post('/brand/{id}/update/status', [BrandController::class, 'updateStatus'])->name('brand.update.status');
    Route::post('/brand/{id}/update/featured', [BrandController::class, 'updateFeatured'])->name('brand.update.featured');
    Route::post('/brand/{id}/logo', [BrandController::class, 'uploadLogoBrand'])->name('brand.update.logo');
    Route::delete('/brand/{id}/delete', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::post('/brand/{id}/update/meta', [BrandController::class, 'updateMeta'])->name('brand.update.meta');
    Route::post('/brand/{id}/form-order', [BrandController::class, 'formOrder'])->name('brand.form-order');

    Route::post('/brand/{id}/game-server', [FormOrderBrandController::class, 'gameServer'])->name('brand.game-server');
    Route::post('/brand/{id}/cek-id', [FormOrderBrandController::class, 'cekId'])->name('brand.cekId');
    Route::post('/brand/{id}/server/store', [FormOrderBrandController::class, 'store'])->name('brand.server.store');
    Route::get('/brand/server/{id}/edit', [FormOrderBrandController::class, 'edit'])->name('brand.server.edit');
    Route::delete('/brand/server/{id}/delete', [FormOrderBrandController::class, 'destroy'])->name('brand.server.destroy');

    Route::get('/type', [TypeController::class, 'index'])->name('type.index');
    Route::get('/fetch-type', [TypeController::class, 'fetchType'])->name('fetch-type');
    Route::post('/type/{id}/update/status', [TypeController::class, 'updateStatus'])->name('type.update.status');
    Route::post('/type/{id}/update/featured', [TypeController::class, 'updateFeatured'])->name('type.update.featured');
    Route::post('/type/{id}/logo', [TypeController::class, 'uploadLogoType'])->name('type.update.logo');
    Route::delete('/type/{id}/delete', [TypeController::class, 'destroy'])->name('type.destroy');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/fetch-pengguna', [PenggunaController::class, 'fetchPengguna'])->name('fetch-pengguna');
    Route::get('/pengguna/{id}/update/status', [PenggunaController::class, 'updateStatus'])->name('pengguna.update.status');
    Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::delete('/pengguna/{id}/delete', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/setting', [SettingsController::class, 'index'])->name('setting.index');
    Route::post('/setting/{id}/update', [SettingsController::class, 'update'])->name('setting.update');
    Route::post('/setting/{id}/update/harga-jual', [SettingsController::class, 'hargaJual'])->name('setting.update.harga-jual');
    Route::post('/setting/{id}/update/email', [SettingsController::class, 'emailSetting'])->name('setting.update.email');
    Route::post('/setting/email/test', [SettingsController::class, 'testMail'])->name('setting.email.test');
    Route::post('/setting/{id}/update/social', [SettingsController::class, 'socialLogin'])->name('setting.update.social');
    Route::post('/setting/{id}/update/google', [SettingsController::class, 'googleLogin'])->name('setting.update.google');

    Route::get('/metode-pembayaran', [MetodePembayaranController::class, 'index'])->name('metode-pembayaran.index');
    Route::get('/fetch-metode-pembayaran', [MetodePembayaranController::class, 'fetchMetodePembayaran'])->name('fetch-metode-pembayaran');
    Route::get('/metode-pembayaran/create', [MetodePembayaranController::class, 'create'])->name('metode-pembayaran.create');
    Route::post('/metode-pembayaran/store', [MetodePembayaranController::class, 'store'])->name('metode-pembayaran.store');
    Route::get('/metode-pembayaran/{id}/edit', [MetodePembayaranController::class, 'edit'])->name('metode-pembayaran.edit');
    Route::post('/metode-pembayaran/{id}/update', [MetodePembayaranController::class, 'update'])->name('metode-pembayaran.update');
    Route::post('/metode-pembayaran/{id}/update/status', [MetodePembayaranController::class, 'updateStatus'])->name('metode-pembayaran.update.status');
    Route::delete('/metode-pembayaran/{id}/delete', [MetodePembayaranController::class, 'destroy'])->name('metode-pembayaran.destroy');


    Route::get('/data/setting', function () {
        $setting = Settings::where('id', 1)->first();
        return $setting;
    })->name('setting');
});

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])
    ->name('auth.google');

Route::get('auth/google/callback', [GoogleSocialiteController::class, 'handleCallback'])
    ->name('google.callback');

Route::get('/server-game/{gamecode}', [ServerGame::class, 'getServerGame'])->name('server-game');

Route::get('/storage', function () {
    Artisan::call('storage:link');
    return 'success';
});

Route::post('/inq/completions', [OpenAiController::class, 'completions'])->name('inq.completions');
