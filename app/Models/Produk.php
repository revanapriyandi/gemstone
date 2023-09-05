<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(BrandProduk::class, 'brand_produk_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }

    public function provider()
    {
        return $this->belongsTo(ProviderProduk::class, 'provider_produk_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeProduk::class, 'type_produk_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }
}
